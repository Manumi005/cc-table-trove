<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Reservation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #5f5f5f;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav img {
            cursor: pointer;
            width: 120px;
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

        main {
            background-color: #fff;
            color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 900px;
            margin-top: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        main h1 {
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 15px;
            font-size: 16px;
            color: #333;
        }

        input[type="date"],
        input[type="time"],
        input[type="number"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 16px;
            width: 100%;
            max-width: 300px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ff4081;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e91e63;
        }

        @media (max-width: 600px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            main {
                padding: 15px;
            }

            input[type="date"],
            input[type="time"],
            input[type="number"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='{{ route('customer.dashboard') }}'">
            <ul>
                <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
                <li><a href="{{ route('customer.reservation.create') }}">Reservations</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Make a Reservation</h1>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <form action="{{ route('customer.reservation.store') }}" method="POST">
            @csrf
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" required>

            <label for="time_slot">Time Slot:</label>
            <input type="time" id="time_slot" name="time_slot" required>

            <label for="party_size">Party Size:</label>
            <input type="number" id="party_size" name="party_size" min="1" max="20" required>

            <button type="submit">Make Reservation</button>
        </form>
    </main>
</body>
</html>