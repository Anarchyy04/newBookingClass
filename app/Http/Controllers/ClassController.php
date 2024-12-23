<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassModel::with('bookings');
    
        // Filter berdasarkan input user
        if ($request->filled('room')) {
            $query->where('room', 'LIKE', '%' . $request->room . '%');
        }
    
        if ($request->filled('day')) {
            $query->where('day', 'LIKE', '%' . $request->day . '%');
        }
    
        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }
    
        if ($request->filled('start_time')) {
            $query->where('start_time', '>=', $request->start_time);
        }
    
        if ($request->filled('end_time')) {
            $query->where('end_time', '<=', $request->end_time);
        }
    
        $classes = $query->get();
        $teachers = Teacher::all();
    
        return view('classes.index', compact('classes', 'teachers'));
    }
    
}
