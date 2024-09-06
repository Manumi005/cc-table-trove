<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper1.jpg') }}') no-repeat center center fixed;

            margin: 0;
            padding: 0;
            background-color: #cd9cc0; /* Use the background color from the previous page */
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav img {
            cursor: pointer;
            width: 150px;
            height: 60px;
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
        }

        nav ul li a:hover::after {
            width: 100%;
            left: 0;
            background-color: #fff;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 5px 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #ff69b4; /* Pink color */
            color: #fff;
            cursor: pointer;
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
            background-color: #8a6378;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
        }

        .profile-image {
            width: 90%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            margin: 0 auto 20px;
        }

        .details-container {
            background-color: #c2e2ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            width: 85%;
            margin-left: 30px
        }

        .details {
            margin-bottom: 20px;
        }

        .details label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        .details p {
            margin: 0 0 15px;
            color: #333;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            display: inline-block;
            padding: 10px;
            background-color: #ee8ec8;
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            align-items:center;
            width: 180px;
            height: 25px;
            margin: 0 10px;

            transition: background-color 0.5s;
        }

        .actions a:hover {
            background-color: #ca87c2;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customers/dashboard'">
            <ul>
                <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
                <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
                <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <div class="profile-icon" onclick="location.href='/customer/profile'">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
            </div>
        </div>
    </header>
    <div class="container">
        <h1>{{ $restaurant->name }}</h1>
        <img src="{{ Storage::url($restaurant->image) }}" alt="{{ $restaurant->name }}" class="profile-image">

        <div class="details-container">
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
                <p>{{ implode(', ', json_decode($restaurant->cuisine_type, true)) }}</p>
                <label>Details:</label>
                <p>{{ $restaurant->details }}</p>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('customer.restaurants') }}">Back to Restaurants</a>
            <a href="{{ route('customer.restaurant.menu', ['id' => $restaurant->id]) }}">View Menu</a>
        </div>
    </div>
</body>
</html>
