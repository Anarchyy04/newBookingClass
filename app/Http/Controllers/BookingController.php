<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, ClassModel $class)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            ]);
    
        Booking::create([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'class_id' => $class->id,
            'is_approved' => false, // Default to not approved
        ]);
    
        return redirect()->route('classes.index')->with('success', 'Class booked! Awaiting approval.');
    }    

    public function index()
{
    $classes = ClassModel::with('bookings')->get(); 
    $teachers = Teacher::all(); // Ambil semua teacher
    return view('classes.index', compact('classes', 'teachers'));
}

public function pendingApproval()
    {
        $teacherId = Auth::guard('teacher')->id(); // Ambil ID teacher yang sedang login
        $bookings = Booking::where('teacher_id', $teacherId)
            ->where('is_approved', false)
            ->with(['student', 'class'])
            ->get();

        return view('bookings.pending', compact('bookings'));
    }

    // Proses approve booking
    public function approve(Request $request, Booking $booking)
    {
        $teacherId = Auth::guard('teacher')->id();

        // Pastikan hanya teacher terkait yang bisa mengapprove
        if ($booking->teacher_id != $teacherId) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['is_approved' => true]);

        // Hapus semua pengajuan lain untuk kelas yang sama
    Booking::where('class_id', $booking->class_id)
    ->where('is_approved', false) // Hanya hapus yang belum di-approve
    ->where('id', '!=', $booking->id) // Kecualikan booking yang di-approve
    ->delete();

        return redirect()->route('bookings.pending')->with('success', 'Booking approved successfully!');
    }

    public function teacherHistory()
{
    $teacherId = Auth::guard('teacher')->id(); 
    $bookings = Booking::where('teacher_id', $teacherId)
        ->where('is_approved', true)
        ->with(['student', 'class'])
        ->get();

    return view('bookings.teacher_history', compact('bookings'));
}

public function studentHistory()
{
    $studentId = Auth::id(); // Ambil ID student yang sedang login
    $bookings = Booking::where('student_id', $studentId)
        ->where('is_approved', true)
        ->with(['teacher', 'class'])
        ->get();

    return view('bookings.student_history', compact('bookings'));
}

public function cancel(Booking $booking)
{
    $studentId = Auth::id(); // Ambil ID student yang sedang login

    // Pastikan hanya student yang melakukan booking yang bisa membatalkan
    if ($booking->student_id != $studentId) {
        abort(403, 'Unauthorized action.');
    }

    $booking->delete(); // Hapus booking

    return redirect()->route('bookings.student_history')->with('success', 'Booking canceled successfully!');
}

    
}


