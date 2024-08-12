<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Edit Menu Item</h1>
    </header>
    <main>
        <form action="{{ route('restaurant.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $menu->name }}" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ $menu->description }}</textarea>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="{{ $menu->price }}" step="0.01" required>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            @if ($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" style="width: 100px;">
            @endif
            <label for="allergens">Allergens:</label>
            <input type="text" id="allergens" name="allergens[]" value="{{ implode(',', $menu->allergens) }}" placeholder="Allergen (Optional)">
            <button type="submit">Update</button>
        </form>
    </main>
</body>
</html>
