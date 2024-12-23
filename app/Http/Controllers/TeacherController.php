<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function showRegistrationForm()
    {
        return view('teachers.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|string|max:255|unique:teachers',
            'username' => 'required|string|max:255|unique:teachers',
            'password' => 'required|string|min:6',
        ]);

        $teacher = Teacher::create([
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::guard('teacher')->login($teacher);

        return redirect()->route('teacher.login'); // Pastikan ini sesuai dengan named route yang benar
    }

    public function showLoginForm()
    {
        return view('teachers.login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('teacher')->attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->route('bookings.pending');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
