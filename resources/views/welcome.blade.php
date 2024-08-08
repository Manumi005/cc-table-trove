<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/wallpaper1.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }

        .welcome-container {
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent black background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Slightly darker shadow for contrast */
            display: inline-block;
            text-align: center;
        }

        .logo-container {
            margin: 10px 0;
        }

        .logo-container img {
            width: 300px; /* Adjust size as needed */
            height: auto;
            display: block;
            margin: 0 auto;
        }

        h1, h2 {
            color: #fff; /* White text color */
            margin: 10px 0;
        }

        h2 {
            font-size: 46px; /* Bigger text size */
        }

        .welcome-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .welcome-buttons button {
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            transition: background-color 0.3s;
            width: 200px;
        }

        .customer-button {
            background-color: #4CAF50; /* Green */
        }

        .customer-button:hover {
            background-color: #45a049;
        }

        .restaurant-button {
            background-color: #008CBA; /* Blue */
        }

        .restaurant-button:hover {
            background-color: #007bb5;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome to</h2>
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo"> <!-- Replace 'logo.png' with your logo image path -->
        </div>
        <div class="welcome-buttons">
        <a href="{{ route('customer.login') }}" style="display: inline-block; padding: 10px 20px; margin: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Customer Login</a>
        <a href="{{ route('restaurant.login') }}" style="display: inline-block; padding: 10px 20px; margin: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Restaurant Login</a>
        </div>
    </div>
</body>
</html>
        
