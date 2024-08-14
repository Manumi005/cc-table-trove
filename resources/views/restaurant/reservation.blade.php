<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <style>
        /* Add styles here or use a separate CSS file */
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='{{ route('restaurant.dashboard') }}'">
            <ul>
                <li><a href="{{ route('restaurant.reservation.index') }}">Reservations</a></li>
                <!-- Add other restaurant navigation links here -->
            </ul>
        </nav>
    </header>

    <main>
        <h1>Reservations</h1>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Party Size</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                    <tr>
                        <td>{{ $reservation->customer_name }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->time }}</td>
                        <td>{{ $reservation->number_of_guests }}</td>
                        <td>{{ $reservation->status }}</td>
                        
                            @if($reservation->status == 'pending')
                                <form action="{{ route('restaurant.reservation.approve', $reservation->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>