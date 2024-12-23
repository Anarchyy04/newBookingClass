@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pending Approvals</h1>
        <div>
            <!-- View History Button -->
            <a href="{{ route('bookings.teacher_history') }}" class="btn btn-info">View History</a>

            <!-- Logout Button -->
            <form action="{{ route('teacher.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <p>No pending approvals found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Capacity</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Student</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->class->room }}</td>
                    <td>{{ $booking->class->capacity }}</td>
                    <td>{{ $booking->class->day }}</td>
                    <td>{{ $booking->class->start_time }} - {{ $booking->class->end_time }}</td>
                    <td>{{ $booking->student->username }}</td> <!-- Update sesuai dengan kolom nama student -->
                    <td>{{ $booking->reason }}</td>
                    <td>
                        <form action="{{ route('bookings.approve', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
