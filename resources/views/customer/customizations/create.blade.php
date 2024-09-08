<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customizations</title>
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
    <h1>Create Customizations</h1>
    <form action="{{ route('customer.reservations.customizations.store') }}" method="POST">
        @csrf

        <!-- Dropdown to select a reservation -->
        <div class="form-group">
            <label for="reservation_id">Select Reservation</label>
            <select class="form-control" name="reservation_id" id="reservation_id">
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">
                        {{ $reservation->customer->name }} - {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Selectable Options -->
        <div class="form-group">
            <label for="customizations">Seating Customizations</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="customizations[]" value="Baby Chair" id="baby_chair">
                <label class="form-check-label" for="baby_chair">Baby Chair</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="customizations[]" value="Wheelchair Accessibility" id="wheelchair">
                <label class="form-check-label" for="wheelchair">Wheelchair Accessibility</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="customizations[]" value="High Chair" id="high_chair">
                <label class="form-check-label" for="high_chair">High Chair</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="customizations[]" value="Booster Seat" id="booster_seat">
                <label class="form-check-label" for="booster_seat">Booster Seat</label>
            </div>
        </div>

        <!-- Special Occasions -->
        <div class="form-group">
            <label for="special_occasion">Special Occasion</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="special_occasion[]" value="Birthday" id="birthday">
                <label class="form-check-label" for="birthday">Birthday</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="special_occasion[]" value="Anniversary" id="anniversary">
                <label class="form-check-label" for="anniversary">Anniversary</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="special_occasion[]" value="Proposal" id="proposal">
                <label class="form-check-label" for="proposal">Proposal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="special_occasion[]" value="Graduation" id="graduation">
                <label class="form-check-label" for="graduation">Graduation</label>
            </div>
        </div>

        <!-- Table Location Preferences -->
        <div class="form-group">
            <label for="table_location">Table Location Preferences</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="table_location" value="Near Window" id="near_window">
                <label class="form-check-label" for="near_window">Near Window</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="table_location" value="Near Entrance" id="near_entrance">
                <label class="form-check-label" for="near_entrance">Near Entrance</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="table_location" value="Private Area" id="private_area">
                <label class="form-check-label" for="private_area">Private Area</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="table_location" value="Outdoor" id="outdoor">
                <label class="form-check-label" for="outdoor">Outdoor</label>
            </div>
        </div>

        <!-- Additional Requests -->
        <div class="form-group">
            <label for="additional_requests">Additional Requests</label>
            <textarea class="form-control" name="additional_requests" id="additional_requests" rows="3">{{ isset($customization) ? $customization->additional_requests : '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Customizations</button>
    </form>
</div>
</body>

</html>
