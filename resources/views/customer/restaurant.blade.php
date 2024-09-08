<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #b9d1ea;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
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


        .search-bar button:hover {
            background-color: #ff45a1; /* Darker pink on hover */
        }

        .profile-icon {
            margin-left: 15px;
            margin-right: 20px;
            cursor: pointer;
        }

        .profile-icon img {
            width: 30px;
            height: 30px;
            margin-right: -10px;
            margin-left: 10px;
            border-radius: 50%;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            margin-top: -60px;

            padding: 20px;
            padding-top: 80px; /* Adjust padding to account for fixed header */
        }

        .top {
            background-color: #8a6378;
            color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .top h1 {
            margin: 0;
            font-size: 40px;
            color: #fff;
            font-weight: bold; /* Make the heading bold */
        }

        .top img {
            border-radius: 15px;
            width: 100px;
            height: auto;
            margin-top: 100px;
        }

        .restaurant-card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .restaurant-card {
            background-color: #e5dbf0;
            border: 1px solid #ddd;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(33.333% - 20px);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            padding-bottom: 60px; /* Add space for buttons */
        }

        .restaurant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .restaurant-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .restaurant-card-content {
            padding: 15px;
        }

        .restaurant-card h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
        }

        .restaurant-card p {
            margin: 0 0 15px;
            font-size: 1em;
            color: #666;
        }

        .restaurant-card .button-container {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            display: flex;
            justify-content: space-between;
        }

        .restaurant-card a {
            padding: 10px 20px;
            background-color: #5481a9;
            color: #fff;
            text-decoration: none;
            border-radius: 15px;
            text-align: center;
            transition: background-color 0.3s;
            flex: 1;
            margin: 0 5px;
        }

        .restaurant-card a:hover {
            background-color: #315778;
        }

        .action-buttons {

            text-align: center;
            margin-bottom: 20px;
        }

        .action-buttons a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7769a7;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 0 10px;
        }

        .action-buttons a:hover {
            background-color: #5c6492;
        }

        @media (max-width: 768px) {
            .restaurant-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .restaurant-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
        <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
            <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <form method="GET" action="{{ route('customer.restaurants') }}">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">

        </form>
        <div class="profile-icon" onclick="location.href='/customer/profile'">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
        </div>
    </div>
</header>

<div class="top">
    <img src="{{ asset('images/restaurant.png') }}" alt="Menu Icon" class="menu-icon">
    <h1>Restaurants</h1>
</div>

<div class="container">
    <div class="action-buttons">
        <a href="{{ route('customer.reservation.create') }}">Make a Reservation</a>
    </div>
    <div class="restaurant-card-container">
        @if($restaurants->isEmpty())
            <p>No restaurants found matching your search criteria.</p>
        @else
            @foreach($restaurants as $restaurant)
                <div class="restaurant-card">
                    <img src="{{ Storage::url($restaurant->image) }}" alt="{{ $restaurant->name }}">
                    <div class="restaurant-card-content">
                        <h2>{{ $restaurant->name }}</h2>
                        <p>{{ $restaurant->details }}</p>
                        <div class="button-container">
                            <a href="{{ route('customer.restaurant.details', $restaurant->id) }}">View Details</a>
                            <a href="{{ route('customer.restaurant.menu', $restaurant->id) }}">View Menu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
</body>
</html>
