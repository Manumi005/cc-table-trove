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
            background-color: #f0f0f0;
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
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .restaurant-card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .restaurant-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(33.333% - 20px);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
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

        .restaurant-card a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff69b4; /* Pink color */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .restaurant-card a:hover {
            background-color: #ff1493; /* Darker pink on hover */
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
                <li><a href="{{ route('customer.reservation.create') }}">Reservations</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <form method="GET" action="{{ route('customer.restaurants') }}">
                <input type="text" name="query" placeholder="Search by name or cuisine type..." value="{{ request('query') }}">
                <button type="submit">Search</button>
            </form>
            <div class="profile-icon" onclick="location.href='/customer/profile'">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Restaurants</h1>
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
                            <a href="{{ route('customer.restaurant.details', $restaurant->id) }}">View Details</a>
                            <a href="{{ route('customer.restaurant.menu', $restaurant->id) }}">View Menu</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>