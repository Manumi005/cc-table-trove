<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Details</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .container {
            max-width: 700px;
            height: auto;
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
            max-width: 200px;
            margin: 0 auto;
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
            text-decoration: none;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .actions a.back-btn {
            background-color: #007bff; /* Blue color for the back button */
        }
        .actions a.add-btn {
            background-color: #568e7a; /* Original color for other buttons */
        }
        .actions button.logout-btn {
            background-color: #dc3545;
        }
        .actions a:hover, .actions button:hover {
            background-color: #248958;
        }
        .actions a.back-btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
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

<body>
    <div class="container">
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
            <p>{{ implode(', ', json_decode($restaurant->cuisine_type)) }}</p>
            <label>Details:</label>
            <p>{{ $restaurant->details }}</p>
        </div>

        <div class="actions">
            <a href='/restaurant/profile' class="back-btn">Go Back to Profile</a>
            <a href="{{ route('customer.restaurants') }}" class="add-btn">Add Restaurant</a>
        </div>
    </div>
</body>
</html>