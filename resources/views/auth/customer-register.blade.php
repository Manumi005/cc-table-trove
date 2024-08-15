<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper4.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #2a1d25;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            color: white;
            opacity: 0.9;
        }
        .register-container h2 {
            margin-bottom: 10px;
            font-size: 24px;
            text-align: center;
            color: #e4cfdc;
        }
        .register-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #fff;
        }
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
            font-size: 14px;
            background-color: #ead8f4;
        }
        .logo-container {
            margin: 10px 0;
        }
        .logo-container img {
            width: 170px;
            height: 75px;
            display: block;
            margin: 0 auto;
        }
        .register-container button {
            width: 50%;
            padding: 10px;
            margin: 0 auto;
            display: block;
            background-color: #9e1e8b;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        .register-container button:hover {
            background-color: #892abc;
        }
        .register-container .no-account {
            margin-top: 15px;
            text-align: center;
        }
        .register-container .no-account a {
            color: #007bff;
            text-decoration: none;
        }
        .register-container .no-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"> <!-- Replace 'logo.png' with your logo image path -->
        </div>
        <h2>Register</h2>
        <form id="register-form" method="POST" action="{{ route('customer.register') }}">
            @csrf
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Register</button>
        </form>
        <div class="no-account">
            <p>Already have an account? <a href="{{ route('customer.login') }}">Login here</a></p>
        </div>
    </div>
</body>
</html>