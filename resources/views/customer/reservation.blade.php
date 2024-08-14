<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Reservation</title>
    <style>
        /* Add styles here or use a separate CSS file */
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='{{ route('customer.dashboard') }}'">
            <ul>
                <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
                <li><a href="{{ route('customer.reservation.create') }}">Reservations</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Make a Reservation</h1>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <form action="{{ route('customer.reservation.store') }}" method="POST">
            @csrf
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" required>

            <label for="time_slot">Time Slot:</label>
            <input type="time" id="time_slot" name="time_slot" required>

            <label for="party_size">Party Size:</label>
            <input type="number" id="party_size" name="party_size" min="1" max="20" required>

            <button type="submit">Make Reservation</button>
        </form>
    </main>
</body>
</html>
