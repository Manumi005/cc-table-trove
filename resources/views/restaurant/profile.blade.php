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
            background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #98b2b8;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }
        nav {
            display: flex;
            align-items: center;
        }
        nav img {
            cursor: pointer;
            width: 150px; /* Adjust size as needed */
            height: auto;
            margin-right: 20px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            position: relative;
        }
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #fff;
            transition: width 0.3s ease;
            -webkit-transition: width 0.3s ease;
        }
        nav ul li a:hover::after {
            width: 100%;
            left: 0;
            background-color: #fff;
        }
        .search-bar {
            display: flex;
            align-items: right;
            flex-grow: 1;
            justify-content: right;
            margin: 0 20px;
        }
        .search-bar input {
            padding: 5px 10px;
            font-size: 16px;
            border: none;
            border-radius: 30px;
            width: 100%;
            max-width: 300px;
            background-color: #d9edff;
        }
        .profile-icon {
            margin-left: 15px;
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #b7d3ee;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-image {
            display: block;
            margin-left: 200px;
            align-items: center;
            width: 200px;
           height: 200px;
            border-radius: 50%;
        }
        .details {
            margin-bottom: 20px;
        }
        .details label {
            font-weight: bold;
            display: block;
            margin: 5px 0 2px;
            margin-left: 10%;
        }
        .details p {
            margin: 0 0 15px;
            padding: 8px;
            border: 1px solid #333;
            border-radius: 20px;
            background-color: #ddefff;
            width: 80%;
            align-items: center;
            margin-left: 10%;
        }
        .actions {
            text-align: center;
        }
        .actions a, .actions button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            color: #fff;
            background-color: #568e7a;
            text-decoration: none;
            border-radius: 20px;
            border: none;
            cursor: pointer;
        }
        .actions button.logout-btn {
            background-color: #dc3545;
        }
        .actions a:hover, .actions button:hover {
            background-color: #248958;
        }
        .actions button.logout-btn:hover {
            background-color: #c82333;
        }
        .edit-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        .edit-icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
    </style>
</head>
<header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/restaurant/dashboard'"> <!-- Replace 'logo.png' with your logo image path -->
            <ul>
                <li> <a href='/restaurant/menu'>Menu Management</a></li>
                <li><a href="/restaurant/reservations">Reservation Management</a></li>
                <li> <a href='/pre-order'>Pre-Order Management</a></li>
                <li> <a href='/payment-verification'>Payment Verification</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <div class="profile-icon" onclick="location.href='/restaurant/profile'">
                <img src="{{ asset('images/restaurant.png') }}" alt="Profile">
            </div>
        </div>
    </header>
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
    
        <img src="{{ Storage::url($restaurant->image) }}" alt="{{ $restaurant->name }}" class="profile-image">
       
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
                $cuisineTypes = $restaurant->cuisine_type;
                if (!is_null($cuisineTypes)) {
                    $cuisineTypes = is_array($cuisineTypes) ? $cuisineTypes : (is_string($cuisineTypes) ? explode(',', $cuisineTypes) : []);
                    if (!empty($cuisineTypes)) {
                        echo htmlspecialchars(implode(', ', $cuisineTypes), ENT_QUOTES, 'UTF-8');
                    } else {
                        echo 'Not specified';
                    }
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