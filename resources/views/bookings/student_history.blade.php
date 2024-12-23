@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Approved Bookings (Student)</h1>
        <div>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Back</a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
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
                    <th>Teacher</th>
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
                    <td>{{ $booking->teacher->username }}</td>
                    <td>
                        <!-- Cancel Button -->
                        <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
