<!-- resources/views/customer/create-reservation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Reservation</title>
</head>
<body>
    <h1>Create New Reservation</h1>
    <form action="{{ route('customer.reservation.store') }}" method="POST">
        @csrf
        <label for="reservation_date">Date:</label>
        <input type="date" name="reservation_date" id="reservation_date" required>
        <label for="time_slot">Time Slot:</label>
        <input type="text" name="time_slot" id="time_slot" required>
        <label for="party_size">Party Size:</label>
        <input type="number" name="party_size" id="party_size" required>
        <label for="restaurant_id">Restaurant:</label>
        <select name="restaurant_id" id="restaurant_id" required>
            <!-- Populate with restaurant options -->
            @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
            @endforeach
        </select>
        <button type="submit">Create Reservation</button>
    </form>
</body>
</html>
