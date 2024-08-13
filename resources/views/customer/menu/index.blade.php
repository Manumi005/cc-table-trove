<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - {{ $restaurant->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
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

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        img {
            width: 120px;
            height: auto;
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
        .allergens,
        .dietary {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .category span,
        .allergens span,
        .dietary span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1>Menu for {{ $restaurant->name }}</h1>
    </header>
    <main>
        <ul>
            @foreach($menus as $menu)
            <li>
                <img src="{{ $menu->image ? asset('storage/' . $menu->image) : 'default-image.jpg' }}" alt="{{ $menu->name }}">
                <div class="details">
                    <h2>{{ $menu->name }}</h2>
                    <p>{{ $menu->description }}</p>
                    <p class="price">Rs.{{ $menu->price }}</p>
                    
                    <!-- Display category -->
                    <p class="category"><span>Category:</span> {{ $menu->category }}</p>
                    
                    <!-- Display allergens -->
                    <p class="allergens"><span>Allergens:</span> {{ $menu->allergens ? $menu->allergens : 'None' }}</p>
                    
                    <!-- Display dietary preferences -->
                    <p class="dietary"><span>Dietary Preferences:</span> {{ $menu->dietary_preferences ? $menu->dietary_preferences : 'None' }}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </main>
</body>

</html>
