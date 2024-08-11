<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Details</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-image {
            display: block;
            max-width: 200px;
            margin: 0 auto;
            border-radius: 8px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details label {
            font-weight: bold;
            display: block;
            margin: 5px 0 2px;
        }
        .details p {
            margin: 0 0 15px;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #e9ecef;
        }
        .actions {
            text-align: center;
        }
        .actions a {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $restaurant->name }}</h1>
        <img src="{{ Storage::url($restaurant->image) }}" alt="{{ $restaurant->name }}" class="profile-image">

        <div class="details">
            <label>Contact Number:</label>
            <p>{{ $restaurant->contact_number }}</p>

            <label>Email:</label>
            <p>{{ $restaurant->email }}</p>

            <label>Address:</label>
            <p>{{ $restaurant->address }}</p>

            <label>Opening Hours:</label>
            <p>{{ $restaurant->opening_hours_start }} - {{ $restaurant->opening_hours_end }}</p>

            <label>Cuisine Type:</label>
            <p>{{ implode(', ', json_decode($restaurant->cuisine_type)) }}</p>

            <label>Details:</label>
            <p>{{ $restaurant->details }}</p>
        </div>

        <div class="actions">
            <a href="{{ route('customer.restaurants') }}">Add Restaurant</a>
        </div>
    </div>
</body>
</html>
