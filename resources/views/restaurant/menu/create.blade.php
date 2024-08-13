<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
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
        main {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], textarea, select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            padding: 10px 20px;
            background-color: #6C63FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #5a54e0;
        }
        .error {
            color: #FF5C5C;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add New Menu Item</h1>
    </header>
    <main>
        <form action="{{ route('restaurant.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="category">Category:</label>
                <input type="checkbox" id="starter" name="category[]" value="Starter" {{ in_array('Starter', old('category', [])) ? 'checked' : '' }}>
                <label for="starter">Starter</label><br>
                <input type="checkbox" id="main-course" name="category[]" value="Main Course" {{ in_array('Main Course', old('category', [])) ? 'checked' : '' }}>
                <label for="main-course">Main Course</label><br>
                <input type="checkbox" id="dessert" name="category[]" value="Dessert" {{ in_array('Dessert', old('category', [])) ? 'checked' : '' }}>
                <label for="dessert">Dessert</label><br>
                <input type="checkbox" id="beverage" name="category[]" value="Beverage" {{ in_array('Beverage', old('category', [])) ? 'checked' : '' }}>
                <label for="beverage">Beverage</label><br>
                <input type="checkbox" id="other" name="category[]" value="Other" {{ in_array('Other', old('category', [])) ? 'checked' : '' }}>
                <label for="other">Other</label><br>
                @error('category')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="allergens">Allergens:</label>
                <input type="text" id="allergens" name="allergens[]" placeholder="Allergen (Optional)">
            </div>
            <div>
                <button type="submit">Add Menu Item</button>
            </div>
        </form>
    </main>
</body>
</html>
