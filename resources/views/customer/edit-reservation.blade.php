<!-- resources/views/customer/edit-reservation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
</head>
<body>
    <h1>Edit Reservation</h1>
    <form action="{{ route('customer.reservation.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="reservation_date">Date:</label>
        <input type="date" name="reservation_date" id="reservation_date" value="{{ $reservation->reservation_date }}" required>
        <label for="time_slot">Time Slot:</label>
        <input type="text" name="time_slot" id="time_slot" value="{{ $reservation->time_slot }}" required>
        <label for="party_size">Party Size:</label>
        <input type="number" name="party_size" id="party_size" value="{{ $reservation->party_size }}" required>
        <label for="restaurant_id">Restaurant:</label>
        <select name="restaurant_id" id="restaurant_id" required>
            <!-- Populate with restaurant options -->
            @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ $restaurant->id == $reservation->restaurant_id ? 'selected' : '' }}>
                    {{ $restaurant->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Update Reservation</button>
    </form>
</body>
</html>
