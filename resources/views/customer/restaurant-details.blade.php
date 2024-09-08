<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }}</title>
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
            max-width: 100px;
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
            color: #000000;
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
            margin-left: 30px;
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
            align-items: center;
            width: 180px;
            height: 25px;
            margin: 0 10px;
            transition: background-color 0.5s;
        }

        .actions a:hover {
            background-color: #ca87c2;
        }
        .actions button {
            padding: 10px 20px;
            background-color: #ff69b4;
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .actions button:hover {
            background-color: #e85b8e;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .actions button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.5);
        }


        /* Rating Container */
        .rating {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        /* Star Rating */
        .star-rating {
            direction: rtl;
            display: inline-block;
            font-size: 3rem;
            cursor: pointer;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
        }

        .star-rating input:checked ~ label {
            color: #f5c518; /* Gold color for filled stars */
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5c518; /* Gold color on hover */
        }

        /* Comments Section */
        .comments-container {
            width: 90%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            c
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        }

        .comments-container h2 {
            margin-top: 0;
            color: #333;
            text-align: center;

        }

        .comment-form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .comment-form textarea {
            resize: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }




        /* Popup Styles */
        .popup {
            display: none; /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Ensure it's on top */
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .popup-content h2 {
            margin-top: 0;
            color: #333;
            font-size: 1.5rem;
            text-align: center;
        }

        .popup-content .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #333;
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .popup-content form {
            display: flex;
            flex-direction: column;
        }

        .popup-content label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .popup-content input[type="text"],
        .popup-content textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .popup-content button[type="submit"] {
            padding: 10px;
            background-color: #ff69b4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .popup-content button[type="submit"]:hover {
            background-color: #e85b8e;
        }

        /* Alert Styles */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            text-align: center;
        }

        .alert.alert-success {
            background-color: #4caf50;
        }

        .alert.alert-danger {
            background-color: #f44336;
        }


        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .overall-rating {
            text-align: center;
            margin-bottom: 20px;
        }

        .overall-rating h1 {
            font-size: 2.5rem;
            margin: 10px 0;
        }

        .stars {
            color: #f5c518;
            font-size: 2rem;
        }

        .review {
            border-bottom: 1px solid #eaeaea;
            padding: 10px 0;
        }

        .review:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


    </style>




    </style>
</head>
<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customers/dashboard'">
        <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <div class="profile-icon" onclick="openReviewPopup()">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
        </div>
    </div>
</header>
<div class="container">


    <div class="details-container">
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
            <p>{{ implode(', ', json_decode($restaurant->cuisine_type, true)) }}</p>
            <label>Details:</label>
            <p>{{ $restaurant->details }}</p>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('customer.restaurants') }}">Back to Restaurants</a>
        <a href="{{ route('customer.restaurant.menu', ['id' => $restaurant->id]) }}">View Menu</a>
    </div>



    <div id="reviewPopup" class="popup">
        <div class="popup-content">
            <button class="close" onclick="closeReviewPopup()">×</button>
            <h2>Write a Review</h2>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="rating">
                    <label for="rating">Rate & Review:</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">☆</label>
                        <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">☆</label>
                        <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">☆</label>
                        <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">☆</label>
                        <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">☆</label>
                    </div>
                </div>
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <div>
                    <label for="user_name">Your Name:</label>
                    <input type="text" name="user_name" id="user_name" placeholder="Enter your name" required>
                </div>
                <label for="review">Your Review:</label>
                <textarea name="review" id="review" placeholder="Write your review here..." rows="4" required></textarea>
                <button type="submit">Submit Review</button>
            </form>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Error Display -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="actions">
            <button onclick="openReviewPopup()">Write a Review</button>
        </div>

        @forelse($reviews as $review)
            <div class="review">
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
                </div>
                <a href="#" class="share-btn">Share</a>
            </div>
        @empty
            <p>No reviews yet.</p>
        @endforelse
    </div>
</div>

    <script>
    function openReviewPopup() {
        document.getElementById('reviewPopup').style.display = 'flex';
    }

    function closeReviewPopup() {
        document.getElementById('reviewPopup').style.display = 'none';
    }
</script>
</body>
</html>
