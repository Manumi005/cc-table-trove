<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
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
            border-radius: 50%;
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
        }
        .actions a.logout-btn {
            background-color: #dc3545;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
        .actions a.logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Restaurant Profile</h1>

        <!-- Display Restaurant Image -->
        @if ($restaurant->image)
            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Restaurant Image" class="profile-image">
        @else
            <img src="{{ asset('images/default-restaurant.png') }}" alt="Default Restaurant Image" class="profile-image">
        @endif

        <div class="details">
            <!-- Restaurant Name -->
            <label for="name">Restaurant Name:</label>
            <p>{{ $restaurant->name }}</p>

            <!-- Email -->
            <label for="email">Email:</label>
            <p>{{ $restaurant->email }}</p>

            <!-- Contact Number -->
            <label for="contact_number">Contact Number:</label>
            <p>{{ $restaurant->contact_number }}</p>

            <!-- Address -->
            <label for="address">Address:</label>
            <p>{{ $restaurant->address }}</p>

            <!-- Cuisine Type -->
            <label for="cuisine_type">Cuisine Type:</label>
            <p>
                @php
                    $cuisineTypes = json_decode($restaurant->cuisine_type, true);
                    if (is_array($cuisineTypes) && !empty($cuisineTypes)) {
                        echo htmlspecialchars(implode(', ', $cuisineTypes), ENT_QUOTES, 'UTF-8');
                    } else {
                        echo 'Not specified';
                    }
                @endphp
            </p>

            <!-- Opening Hours -->
            <label for="opening_hours">Opening Hours:</label>
            <p>{{ $restaurant->opening_hours_start }} to {{ $restaurant->opening_hours_end }}</p>

            <!-- Details -->
            <label for="details">Details:</label>
            <p>{{ $restaurant->details }}</p>
        </div>

        <div class="actions">
            <a href="{{ route('restaurant.profile.edit') }}">Edit Profile</a>
            <a href="{{ route('restaurant.dashboard') }}">Back to Dashboard</a>
            <a href="{{ route('restaurant.logout') }}" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>
