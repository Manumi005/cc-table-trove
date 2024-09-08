<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Offer</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #b0c7d4;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/wallpaper1.jpg') }}') no-repeat center center fixed;
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
            margin-left: 15px;
            cursor: pointer;
        }

        .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .top {
            background-color: #6397b5;
            color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .top h1 {
            margin: 0;
            font-size: 2.5rem;
            text-align: center;
            margin-top: -90px;
            margin-bottom: 30px;
            margin-left: 150px;
        }

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        form input[type="text"],
        form textarea,
        form input[type="date"] {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        form input[type="file"] {
            margin-bottom: 20px;
        }

        form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        .cancel-link {
            display: inline-block;
            margin-top: 10px;
            color: #6397b5;
            text-decoration: none;
            font-weight: bold;
        }

        .cancel-link:hover {
            text-decoration: underline;
        }

        .menu-icon {
            width: 80px;
            height: auto;
            margin: 30px;
            margin-left: 400px;
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
            <li><a href='/pre-order'>Pre-Order Management</a></li>
            <li><a href='/payment-verification'>Payment Verification</a></li>
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
<div class="top">
    <img src="{{ asset('images/offersnpromos.png') }}" alt="Offer Icon" class="menu-icon">
    <h1>Add New Offer</h1>
</div>
<main>
    <form action="{{ route('restaurant.offers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Offer Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="discount">Discount Percentage:</label>
        <input type="text" id="discount" name="discount" required>

        <label for="valid_from">Valid From:</label>
        <input type="date" id="valid_from" name="valid_from" required>

        <label for="valid_until">Valid Until:</label>
        <input type="date" id="valid_until" name="valid_until" required>

        <label for="image">Offer Image:</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Add Offer</button>
    </form>
    <a href="{{ route('restaurant.offers.index') }}" class="cancel-link">Cancel</a>
</main>
</body>


</html>
