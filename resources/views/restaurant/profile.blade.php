<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0f7ff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: #0056b3;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            position: relative;
            color: #000;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #000;
        }
        .profile-image {
            display: block;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .details {
            margin-top: 15px;
        }
        .details label {
            font-weight: 600;
            display: block;
            margin: 8px 0 3px;
            color: #000;
            font-size: 0.9em;
        }
        .details p {
            margin: 0 0 15px;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #cce0ff;
            font-size: 0.95em;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
            color: #000;
        }
        .actions {
            text-align: center;
            margin-top: 25px;
        }
        .actions a, .actions button {
            display: inline-block;
            padding: 10px 20px;
            margin: 8px;
            color: #fff;
            background-color: #00408a;
            text-decoration: none;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            box-shadow: 0 5px 15px rgba(0,64,138,0.3);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .actions button.logout-btn {
            background-color: #c82333;
        }
        .actions a:hover, .actions button:hover {
            background-color: #002d61;
            box-shadow: 0 7px 20px rgba(0,45,97,0.4);
        }
        .actions button.logout-btn:hover {
            background-color: #a71d2a;
            box-shadow: 0 7px 20px rgba(167,29,42,0.4);
        }
        .edit-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 30px;
            height: 30px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .edit-icon img {
            width: 100%;
            height: 100%;
        }
        .edit-icon:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Edit Profile Icon -->
        <div class="edit-icon">
            <a href="{{ route('restaurant.profile.edit') }}">
                <img src="{{ asset('images/edit-icon.png') }}" alt="Edit Profile">
            </a>
        </div>

        <h1>Restaurant Profile</h1>

        <!-- Display Restaurant Image -->
        @if ($restaurant->image)
            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Restaurant Image" class="profile-image">
        @else
            <img src="{{ asset('images/default-restaurant.png') }}" alt="Default Restaurant Image" class="profile-image">
        @endif

        <div class="details">
            <!-- Restaurant Detailed Information -->
            <label for="name">Restaurant Name:</label>
            <p>{{ $restaurant->name }}</p>

            <label for="email">Email:</label>
            <p>{{ $restaurant->email }}</p>

            <label for="contact_number">Contact Number:</label>
            <p>{{ $restaurant->contact_number }}</p>

            <label for="address">Address:</label>
            <p>{{ $restaurant->address }}</p>

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

            <label for="opening_hours">Opening Hours:</label>
            <p>
                @if ($restaurant->opening_hours_start && $restaurant->opening_hours_end)
                    {{ $restaurant->opening_hours_start }} to {{ $restaurant->opening_hours_end }}
                @else
                    Not specified
                @endif
            </p>

            <label for="details">Details:</label>
            <p>{{ $restaurant->details }}</p>
        </div>

        <div class="actions">
            <a href="{{ route('restaurant.dashboard') }}">Back to Dashboard</a>

            <!-- View Summary Button -->
            <a href="{{ route('restaurant.summary') }}">View Summary</a>

            <!-- Logout Form -->
            <form action="{{ route('restaurant.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
