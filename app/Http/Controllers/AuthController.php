<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:students',
            'nim' => 'required|min:6|numeric',
            'password' => 'required|min:6',
        ]);
    
        Student::create([
            'username' => $request->username,
            'nim' => $request->nim,
            'password' => bcrypt($request->password),
        ]);
    
        // Redirect ke halaman login setelah registrasi
        return redirect()->route('login');
    }
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('classes.index');
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
