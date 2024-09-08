<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customizations for Reservations</title>
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
            max-width: 800px;
            width: 100%;
        }

        h1 {
            color: #fff;
            margin-bottom: 30px;
            font-size: 2rem;
            text-align: center;
            font-weight: bold;
        }

        .customization-summary {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .customization-summary h4 {
            color: #ffc107;
            margin-bottom: 10px;
        }

        .customization-summary p,
        .customization-summary ul {
            color: #adb5bd;
            font-size: 1rem;
        }

        .edit-btn, .delete-btn {
            padding: 8px 15px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 10px;
        }

        .edit-btn {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .edit-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            margin-left: 10px;
        }

        .delete-btn:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Customizations Summary</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($customizations->isEmpty())
        <p>No customizations found.</p>
        <a href="{{ route('customer.reservations.customizations.create', ['reservation_id' => $reservationId]) }}" class="btn btn-primary">Create a Customization</a>
    @else
        @foreach($customizations as $customization)
            <div class="customization-summary">
                <h4>
                    Reservation Customization For
                    {{ $customization->reservation->customer->name ?? 'N/A' }} -
                    {{ \Carbon\Carbon::parse($customization->reservation->reservation_date ?? '')->format('Y-m-d') }}
                </h4>
                <p><strong>Seating:</strong></p>
                <ul>
                    @foreach(json_decode($customization->customizations) as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>

                <p><strong>Special Occasions:</strong></p>
                <ul>
                    @foreach(json_decode($customization->special_occasion) as $occasion)
                        <li>{{ $occasion }}</li>
                    @endforeach
                </ul>

                <p><strong>Table Location:</strong> {{ $customization->table_location }}</p>

                <p><strong>Additional Requests:</strong> {{ $customization->additional_requests }}</p>

{{--                <!-- Edit and Delete Buttons -->--}}
{{--                <a href="{{ route('customer.reservations.customizations.edit', ['reservation_id' => $customization->reservation_id, 'id' => $customization->id]) }}" class="edit-btn">Edit Customization</a>--}}

{{--                <form action="{{ route('customer.reservations.customizations.destroy', ['reservation_id' => $customization->reservation_id, 'id' => $customization->id]) }}" method="POST" style="display:inline;">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this customization?')">Delete</button>--}}
{{--                </form>--}}
{{--            </div>--}}
        @endforeach
    @endif
    <a href="/restaurant/reservations" class="btn btn-primary ml-2">Return to Reservation Management</a>
</div>
</body>
</html>
