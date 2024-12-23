@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex justify-content-center align-items-center m-0 p-0" 
     style="background: linear-gradient(to bottom, #e0f7fa, #b2ebf2);">
    <div class="text-center w-100">
        <!-- Logo UIN -->
        <img src="{{ asset('logo.png') }}" alt="UIN Logo" 
             style="width: 200px; margin-bottom: 20px;"> <!-- Ukuran logo sedang -->
        <div class="card mx-auto shadow-lg border-0" 
             style="width: 100%; max-width: 700px; border-radius: 15px; overflow: hidden;"> <!-- Lebar lebih besar -->
            <div class="card-header bg-primary text-white text-center" style="padding: 15px;">
                <h4>Register as Student</h4>
            </div>
            <div class="card-body px-5 py-4"> <!-- Padding lebih kecil -->
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM:</label>
                        <input type="text" class="form-control form-control-lg" name="nim" placeholder="Enter your NIM" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
