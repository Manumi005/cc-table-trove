<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers and Promotions</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #333;
        background-image: url('{{ asset('images/wallpaper1.jpg') }}');
        margin: 0;
        padding: 0;
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
        width: 150px;
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
        margin-left: 20px;
        margin-right: 0px;
        cursor: pointer;
    }

    .profile-icon img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
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
        font-size: 2.5rem;
    }

    main {
        padding: 20px;
        max-width: 1200px;
        margin: auto;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .offer-card {
        position: relative;
        background-color:  #f0ded1;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .offer-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .offer-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .offer-content {
        padding: 20px;
    }

    .offer-title {
        font-size: 1.25rem;
        margin: 0 0 10px 0;
        color: #333;
    }

    .offer-description {
        font-size: 1rem;
        margin: 0 0 15px 0;
        color: #555;
    }

    .offer-details {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .discount-badge {
        background-color: #03dac6;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .validity {
        color: #888;
        font-size: 0.9rem;
    }

    .promo-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color:  #03dac6;
        color: #fff;
        padding: 10px;
        border-radius: 10px;
        transform: rotate(10deg);
        font-size: 0.9rem;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    button.preorder {
        background-color: #03dac6;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 1rem;
        text-align: center;
        display: block;
        margin: 20px auto;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .top img {
        border-radius: 15px;
        width: 100px;
        height: auto;
    }

    button.preorder:hover {
        background-color: #00c4a3;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .offer-content {
            padding: 15px;
        }
    }
</style>

<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
        <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="/customer/reservations">Reservations</a></li>
            <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <div class="profile-icon">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile" onclick="location.href='/customer/profile'">
        </div>
    </div>
</header>

<div class="top">
    <img src="{{ asset('images/offersnpromos.png') }}" alt="Menu Icon" class="menu-icon">
    <h1>Offers and Promotions</h1>
</div>

<main>
    <div class="grid-container">
        @foreach($offers as $offer)
            <a href="{{ route('customer.restaurant.details', $offer->restaurant->id) }}" class="offer-card">
            <img class="offer-image" src="{{ $offer->image ? asset('storage/' . $offer->image) : '' }}" alt="{{ $offer->title }}">
                <div class="promo-tag">{{ $offer->discount }}% OFF</div>
                <div class="offer-content">
                    <h2 class="offer-title">{{ $offer->title }}</h2>
                    <p>Restaurant: <span>{{ $offer->restaurant->name }}</span></p>
                    <p class="offer-description">{{ $offer->description }}</p>
                    <div class="offer-details">

                        <span class="validity">Valid From: {{ $offer->valid_from->format('d M Y') }}</span>
                        <span class="validity">Valid Until: {{ $offer->valid_until->format('d M Y') }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</main>

<script>
    // Add any JavaScript if needed for interactions
</script>

</body>

</html>
