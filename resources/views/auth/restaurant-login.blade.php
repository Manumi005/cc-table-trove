<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url({{ asset('images/wallpaper3.jpg') }}) no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }
        .login-container {
            background-color: #2a1d25;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            color: white;
            opacity: 0.9;
        }
        .login-container h2 {
            margin-bottom: 10px;
            font-size: 24px;
            text-align: center;
            color: #e4cfdc;
        }
        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #fff;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
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
        .login-container button {
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
        .login-container button:hover {
            background-color: #892abc;
        }
        .login-container .no-account {
            margin-top: 15px;
            text-align: center;
        }
        .login-container .no-account a {
            color: #007bff;
            text-decoration: none;
        }
        .login-container .no-account a:hover {
            text-decoration: underline;
        }
        .error-messages {
            background-color: #ffdddd;
            color: #d8000c;
            border: 1px solid #d8000c;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"> <!-- Replace 'logo.png' with your logo image path -->
        </div>
        <h2>Restaurant Login</h2>
        <form method="POST" action="{{ route('restaurant.login') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <div class="no-account">
            <p>Don't have an account? <a href="{{ route('restaurant.register') }}">Register here</a></p>
        </div>
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
