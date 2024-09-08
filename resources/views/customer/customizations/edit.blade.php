<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customizations</title>
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
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Edit Customizations</h1>
        <form action="{{ route('customer.reservations.customizations.update', ['reservation_id' => $customization->reservation_id, 'id' => $customization->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Hidden field for reservation_id -->
        <input type="hidden" name="reservation_id" value="{{ $customization->reservation_id }}">

        <!-- Selectable Options -->
        <div class="form-group">
            <label for="customizations">Seating Customizations</label>
            @foreach(['Baby Chair', 'Wheelchair Accessibility', 'High Chair', 'Booster Seat'] as $option)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="customizations[]" value="{{ $option }}" id="{{ Str::slug($option) }}" {{ in_array($option, (array) $customization->customizations) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ Str::slug($option) }}">{{ $option }}</label>
                </div>
            @endforeach
        </div>

        <!-- Special Occasions -->
        <div class="form-group">
            <label for="special_occasion">Special Occasion</label>
            @foreach(['Birthday', 'Anniversary', 'Proposal', 'Graduation'] as $occasion)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="special_occasion[]" value="{{ $occasion }}" id="{{ Str::slug($occasion) }}" {{ in_array($occasion, (array) $customization->special_occasion) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ Str::slug($occasion) }}">{{ $occasion }}</label>
                </div>
            @endforeach
        </div>

        <!-- Table Location Preferences -->
        <div class="form-group">
            <label for="table_location">Table Location Preferences</label>
            @foreach(['Near Window', 'Near Entrance', 'Private Area', 'Outdoor'] as $location)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="table_location" value="{{ $location }}" id="{{ Str::slug($location) }}" {{ $customization->table_location === $location ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ Str::slug($location) }}">{{ $location }}</label>
                </div>
            @endforeach
        </div>
        <!-- Additional Requests -->
        <div class="form-group">
            <label for="additional_requests">Additional Requests</label>
            <textarea class="form-control" name="additional_requests" id="additional_requests" rows="3">{{ isset($customization) ? $customization->additional_requests : '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Customizations</button>
    </form>
</div>
</body>
</html>
