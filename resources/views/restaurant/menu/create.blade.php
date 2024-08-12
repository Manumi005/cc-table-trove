<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Add New Menu Item</h1>
    </header>
    <main>
        <form action="{{ route('restaurant.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <label for="allergens">Allergens:</label>
            <input type="text" id="allergens" name="allergens[]" placeholder="Allergen (Optional)">
            <button type="submit">Save</button>
        </form>
    </main>
</body>
</html>
