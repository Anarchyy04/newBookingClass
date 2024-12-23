@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex justify-content-center align-items-center" 
     style="background: linear-gradient(to bottom, #e0f7fa, #ffffff); margin: 0; padding: 0; width: 100%; height: 100%;">
    <div class="w-100 text-center">
        <!-- Logo UIN dengan ukuran lebih besar -->
        <img src="{{ asset('logo.png') }}" alt="UIN Logo" style="width: 150px; margin-bottom: 20px;">
        <div class="card shadow-lg py-5 px-4 mx-auto" 
             style="width: 100%; max-width: 500px; border-radius: 10px; background: #ffffff;">
            <h1 class="card-title mb-4">Welcome to UIN</h1>
            <p class="card-text mb-4">Please select your role:</p>
            <div class="row">
                <div class="col-6">
                    <!-- Tombol untuk Student -->
                    <a href="/register" class="btn btn-primary mb-3 w-100">Register as Student</a>
                    <a href="/login" class="btn btn-secondary w-100">Login as Student</a>
                </div>
                <div class="col-6">
                    <!-- Tombol untuk Teacher -->
                    <a href="/teacher/register" class="btn btn-primary mb-3 w-100">Register as Lecturer</a>
                    <a href="/teacher/login" class="btn btn-secondary w-100">Login as Lecturer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
