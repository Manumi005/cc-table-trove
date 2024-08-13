<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #6C63FF;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        header a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        img {
            border-radius: 10px;
            margin-right: 20px;
            width: 100px;
            height: auto;
        }
        h2 {
            margin: 0 0 10px;
            font-size: 1.5rem;
            color: #6C63FF;
        }
        p {
            margin: 0 0 10px;
            font-size: 1rem;
        }
        a {
            color: #6C63FF;
            text-decoration: none;
            font-weight: bold;
            margin-right: 15px;
        }
        button {
            padding: 8px 15px;
            background-color: #FF5C5C;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #FF4040;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manage Your Menu</h1>
        <a href="{{ route('restaurant.menu.create') }}">Add New Menu Item</a>
    </header>
    <main>
        <ul>
            @foreach($menus as $menu)
                <li>
                    <img src="{{ $menu->image ? asset('storage/' . $menu->image) : '' }}" alt="{{ $menu->name }}">
                    <div>
                        <h2>{{ $menu->name }}</h2>
                        <p>{{ $menu->description }}</p>
                        <p>${{ number_format($menu->price, 2) }}</p>
                        <p>Quantity: {{ $menu->quantity }}</p>
                        
                        <!-- Check if category is an array and not empty -->
                        <p>Category: {{ is_array($menu->category) && !empty($menu->category) ? implode(', ', $menu->category) : 'N/A' }}</p>
                        
                        <!-- Check if allergens is an array and not empty -->
                        <p>Allergens: {{ is_array($menu->allergens) && !empty($menu->allergens) ? implode(', ', $menu->allergens) : 'None' }}</p>
                        
                        <a href="{{ route('restaurant.menu.edit', $menu->id) }}">Edit</a>
                        <form action="{{ route('restaurant.menu.destroy', $menu->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </main>
</body>
</html>
