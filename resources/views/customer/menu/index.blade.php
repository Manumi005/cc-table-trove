<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - {{ $restaurant->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Menu for {{ $restaurant->name }}</h1>
    </header>
    <main>
        <ul>
            @foreach($menus as $menu)
                <li>
                    <img src="{{ $menu->image ? asset('storage/' . $menu->image) : '' }}" alt="{{ $menu->name }}" style="width: 100px;">
                    <h2>{{ $menu->name }}</h2>
                    <p>{{ $menu->description }}</p>
                    <p>${{ $menu->price }}</p>
                </li>
            @endforeach
        </ul>
    </main>
</body>
</html>
