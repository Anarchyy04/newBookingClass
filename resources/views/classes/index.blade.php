@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex flex-column" 
     style="background: linear-gradient(to bottom, #e0f7fa, #ffffff); margin: 0; padding: 0;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-3" href="#">Available Classes</a> <!-- Tulisan lebih besar dan bold -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Filter Form -->
    <div class="container mt-4">
        <form method="GET" action="{{ route('classes.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="room" class="form-control" placeholder="Filter by Room" value="{{ request('room') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="day" class="form-control" placeholder="Filter by Day" value="{{ request('day') }}">
                </div>
                <div class="col-md-3">
                    <input type="number" name="capacity" class="form-control" placeholder="Filter by Capacity" value="{{ request('capacity') }}">
                </div>
                <div class="col-md-3 d-flex">
                    <!-- Start Time -->
                    <input type="time" name="start_time" class="form-control me-2" placeholder="Start Time" value="{{ request('start_time') }}">
                    <!-- End Time -->
                    <input type="time" name="end_time" class="form-control" placeholder="End Time" value="{{ request('end_time') }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- History Button -->
        <div class="mt-3">
            <a href="{{ route('bookings.student_history') }}" class="btn btn-info">View My History</a>
        </div>

        <!-- Class Cards -->
        <div class="row mt-4">
            @foreach($classes as $class)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Room: {{ $class->room }}</h5>
                        <p class="card-text">
                            <strong>Capacity:</strong> {{ $class->capacity }}<br>
                            <strong>Day:</strong> {{ $class->day }}<br>
                            <strong>Time:</strong> {{ $class->start_time }} - {{ $class->end_time }}
                        </p>
                        @if($class->bookings->where('is_approved', true)->count() > 0)
                            <span class="badge bg-success">Booked</span>
                        @else
                            <span class="badge bg-warning">Available</span>
                            <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $class->id }}">Book Now</button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal for Booking -->
            <div class="modal fade" id="bookingModal{{ $class->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $class->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel{{ $class->id }}">Book Class: {{ $class->room }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('classes.book', $class->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" name="student_id" value="{{ auth()->id() }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="teacher_id" class="form-label">Teacher ID</label>
                                    <select class="form-select" name="teacher_id" required>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
