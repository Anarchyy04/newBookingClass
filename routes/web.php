<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

             
Route::get('/teacher/register', [TeacherController::class, 'showRegistrationForm'])->name('teacher.register');
Route::post('/teacher/register', [TeacherController::class, 'register']);
Route::get('/teacher/login', [TeacherController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [TeacherController::class, 'login']);
Route::post('/teacher/logout', [AuthController::class, 'logout'])->name('teacher.logout');


Route::get('/', function () {
    return view('role_selection');
});


Route::get('/classes', [ClassController::class, 'index'])->name('classes.index')->middleware('auth');
Route::post('/classes/{class}/book', [BookingController::class, 'store'])->middleware('auth')->name('classes.book');


Route::get('/teacher/dashboard', [BookingController::class, 'pendingApproval'])
    ->middleware('auth:teacher')
    ->name('bookings.pending');

Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])
    ->middleware('auth:teacher')
    ->name('bookings.approve');

Route::get('/bookings/teacher/history', [BookingController::class, 'teacherHistory'])
    ->middleware('auth:teacher')
    ->name('bookings.teacher_history');

// History untuk student
Route::get('/bookings/student/history', [BookingController::class, 'studentHistory'])
    ->middleware('auth')
    ->name('bookings.student_history');


    Route::delete('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])
    ->middleware('auth')
    ->name('bookings.cancel');
