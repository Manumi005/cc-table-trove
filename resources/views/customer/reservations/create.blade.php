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
            background: url('{{ asset('images/wallpaper5.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            color: #fff;
            margin-bottom: 30px;
            font-size: 2rem;
            text-align: center;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
            color: #adb5bd;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            color: #fff;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .text-danger {
            color: #ff6b6b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            padding: 10px 20px;
            font-size: 1.125rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .form-group {
            margin-bottom: 20px;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.875rem;
                padding: 8px;
            }

            .btn-primary {
                font-size: 1rem;
                padding: 8px 15px;
            }
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
