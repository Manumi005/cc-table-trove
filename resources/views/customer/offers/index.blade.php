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
    /* Your existing styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
        color: #333;
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
        margin-left: 40px;
        margin-right: -20px;
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
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .top h1 {
        margin: 0;
        font-size: 2.5rem;
    }

    main {
        padding: 20px;
        max-width: 1200px;
        margin: auto;
        background-color: none;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-button {
        background-color: #cd77ad;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 1rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .filter-button i {
        margin-right: 8px;
    }

    .filter-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
    }

    .filter-modal-content {
        background: #cce3f3;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-modal-content h2 {
        margin-top: 0;
    }

    .filter-modal-content label {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .filter-modal-content input[type="checkbox"] {
        margin-right: 10px;
    }

    .filter-modal-content .slider {
        width: 100%;
        margin: 10px 0;
    }

    .filter-modal-content .slider-label {
        font-size: 0.9rem;
        color: #666;
    }

    .filter-modal-content button {
        background-color: #6C63FF;
        color: #333;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        margin-right: 10px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .container li {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #d6b8dc;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        display: flex;
        color: #333333;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 8px solid #6397b5;
    }

    .container li:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    img {
        width: 250px;
        height: 250px;
        border-radius: 8px;
        margin-right: 20px;
    }

    .details {
        flex: 1;
    }

    h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #333;
    }

    p {
        margin: 5px 0;
    }

    .price {
        font-size: 1.2rem;
        color: #6C63FF;
        font-weight: bold;
    }

    .category,
    .offer-type {
        margin-top: 10px;
        font-size: 0.9rem;
        color: #666;
    }

    .category span,
    .offer-type span {
        font-weight: bold;
    }

    .order-icon {
        cursor: pointer;
        margin-left: 10px;
        color: #6C63FF;
    }

    .quantity-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
    }

    .quantity-modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .quantity-modal-content input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Add these styles for the 'Go to Pre Order' button */
    button.preorder {
        background-color: #6C63FF; /* Match the color theme */
        color: #fff; /* White text color */
        border: none; /* Remove default border */
        border-radius: 5px; /* Rounded corners */
        padding: 10px 20px; /* Spacing around the text */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 1rem; /* Font size */
        text-align: center; /* Center the text */
        display: block; /* Block level element */
        margin: 20px auto; /* Center the button horizontally with margin */
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition */
    }

    button.preorder:hover {
        background-color: #5a54d7; /* Slightly darker shade on hover */
        transform: scale(1.05); /* Slightly increase size on hover */
    }

    button.preorder:focus {
        outline: none; /* Remove default outline */
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2); /* Add subtle shadow */
    }

    @media (max-width: 768px) {
        .container li {
            flex-direction: column;
            text-align: center;
        }

        img {
            width: 100%;
            height: auto;
        }
    }
</style>

<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='{{ url('/') }}'">
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/offers') }}">Offers & Promotions</a></li>
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>
        <div class="search-bar">
            <input type="text" placeholder="Search restaurants...">
        </div>
        <div class="profile-icon">
            <img src="{{ asset('images/profile-icon.png') }}" alt="Profile">
        </div>
    </nav>
</header>

<div class="top">
    <h1>Offers and Promotions</h1>
</div>

<main>
    <button class="filter-button" onclick="toggleFilterModal()"><i class="fas fa-filter"></i> Filter</button>

    <!-- Filter Modal -->
    <div id="filter-modal" class="filter-modal">
        <div class="filter-modal-content">
            <h2>Filter Offers</h2>
            <label>
                <input type="checkbox" name="offer-type" value="discount"> Discount Offers
            </label>
            <label>
                <input type="checkbox" name="offer-type" value="buy-one-get-one"> Buy One Get One Free
            </label>
            <label>
                <input type="checkbox" name="offer-type" value="happy-hour"> Happy Hour
            </label>
            <div class="slider-label">Price Range</div>
            <input type="range" min="0" max="100" step="1" class="slider" id="price-range">
            <button onclick="applyFilters()">Apply</button>
            <button onclick="closeFilterModal()">Close</button>
        </div>
    </div>

    <ul class="container">
        @foreach($offers as $offer)
            <li>
                <img src="{{ $offer->image ? asset('storage/' . $offer->image) : '' }}" alt="{{ $offer->title }}">
                <div class="item">
                    <a href="{{ route('restaurant.details', $offer->id) }}">
                    <h2>{{ $offer->title }}</h2>
                    <p>Description: <span>{{ $offer->description }}</span></p>
                    <p>Discount: <span>{{ $offer->discount }}%</span></p>
                    <p>Valid From: <span>{{ $offer->valid_from->format('d M Y') }}</span></p>
                    <p>Valid Until: <span>{{ $offer->valid_until->format('d M Y') }}</span></p>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</main>

<script>
    function toggleFilterModal() {
        const modal = document.getElementById('filter-modal');
        modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
    }

    function closeFilterModal() {
        document.getElementById('filter-modal').style.display = 'none';
    }

    function applyFilters() {
        // Implement filter logic here
        closeFilterModal();
    }
</script>
</body>

</html>
