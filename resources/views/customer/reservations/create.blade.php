<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: white;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: bold;
        }
        .text-danger {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Reservation</h1>
        <form action="{{ route('customer.reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="restaurant_id">Restaurant</label>
                <select name="restaurant_id" id="restaurant_id" class="form-control" required>
                    <option value="" disabled selected>Select a restaurant</option>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
                @error('restaurant_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="reservation_date">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ old('reservation_date') }}" required>
                @error('reservation_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="time_slot">Time Slot</label>
                <input type="time" name="time_slot" id="time_slot" class="form-control" value="{{ old('time_slot') }}" required>
                @error('time_slot')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="party_size">Party Size</label>
                <input type="number" name="party_size" id="party_size" class="form-control" value="{{ old('party_size') }}" min="1" max="10" required>
                @error('party_size')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit Reservation</button>
        </form>
    </div>
</body>
</html>
