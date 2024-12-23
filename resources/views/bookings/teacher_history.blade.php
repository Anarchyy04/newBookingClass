@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Approved Bookings (Teacher)</h1>
        <div>
            <!-- Back Button -->
            <a href="{{ route('bookings.pending') }}" class="btn btn-secondary">Back</a>
            
            <!-- Logout Button -->
            <form action="{{ route('teacher.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    @if($bookings->isEmpty())
        <p>No approved bookings found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Capacity</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Student</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->class->room }}</td>
                    <td>{{ $booking->class->capacity }}</td>
                    <td>{{ $booking->class->day }}</td>
                    <td>{{ $booking->class->start_time }} - {{ $booking->class->end_time }}</td>
                    <td>{{ $booking->student->username }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
