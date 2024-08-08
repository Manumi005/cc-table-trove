<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <h1>Welcome to My Application</h1>
        <p>Please choose your login option:</p>
        <div>
            <a href="{{ route('customer.login') }}" style="display: inline-block; padding: 10px 20px; margin: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Customer Login</a>
            <a href="{{ route('restaurant.login') }}" style="display: inline-block; padding: 10px 20px; margin: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Restaurant Login</a>
        </div>
    </div>
</body>
</html>

