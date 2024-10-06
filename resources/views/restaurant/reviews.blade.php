<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Existing CSS... */
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper1.jpg') }}') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #cd9cc0;
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
            background-color: #ff69b4;
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
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
            color: #000000;
        }

        .review {
            background-color: #f9f9f9; /* Light grey for review background */
            border: 1px solid #ccc; /* Border around reviews */
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            transition: transform 0.2s, box-shadow 0.2s; /* Animation for hover effect */
        }

        .review:hover {
            transform: scale(1.02); /* Slight zoom effect on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stars {
            color: #f5c518; /* Gold color for stars */
            font-size: 1.5em;
        }

        .review-body {
            margin-top: 10px;
        }

        .review-body p {
            margin: 0 0 10px;
            color: #333;
        }

        .actions {
            text-align: right;
        }

        .actions button {
            padding: 8px 15px;
            background-color: #ff69b4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #e85b8e;
        }

        /* Flagged Review Styles */
        .flagged {
            background-color: #FF7F7F; /* Light red background for flagged reviews */
            border-color: #f44336; /* Dark red border for flagged reviews */
        }

        /* General Button Styles */
        button {
            font-size: 16px;
            margin-top: 10px;
        }

    </style>
</head>
<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/restaurant/dashboard'">
        <ul>
            <li><a href='/restaurant/menu'>Menu Management</a></li>
            <li><a href="/restaurant/reservations">Reservation Management</a></li>
            <li><a href="{{ url()->current() }}">Review Management</a></li>
            <li><a href='/restaurant/offers'>Offers Management</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <div class="profile-icon" onclick="location.href='/restaurant/profile'">
            <img src="{{ asset('images/restaurant.png') }}" alt="Profile">
        </div>
    </div>
</header>
<div class="container">
    <h1>Manage Reviews</h1>
    @forelse($reviews as $review)
        <div class="review @if($review->flag_status) flagged @endif">
            <div class="review-header">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <p>{{ $review->user_name }} - {{ $review->created_at->format('F d, Y') }}</p>
            </div>
            <div class="review-body">
                <p>{{ $review->review }}</p>
                <div class="actions">
                    @if($review->flag_status)
                        <p>This review has been flagged.</p>
                        <form action="{{ route('reviews.unflag', $review->id) }}" method="POST">
                            @csrf
                            <button type="submit">Unflag Review</button>
                        </form>
                    @else
                        <form action="{{ route('reviews.flag', $review->id) }}" method="POST">
                            @csrf
                            <button type="submit">Flag Review</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse
</div>
</body>
</html>
