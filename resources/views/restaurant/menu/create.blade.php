<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>

        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #98b2b8;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }
        nav {
            display: flex;
            align-items: center;
        }
        nav img {
            cursor: pointer;
            width: 150px; /* Adjust size as needed */
            height: auto;
            margin-right: 20px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            position: relative;
        }
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #fff;
            transition: width 0.3s ease;
            -webkit-transition: width 0.3s ease;
        }
        nav ul li a:hover::after {
            width: 100%;
            left: 0;
            background-color: #fff;
        }
        .search-bar {
            display: flex;
            align-items: right;
            flex-grow: 1;
            justify-content: right;
            margin: 0 20px;
        }
        .search-bar input {
            padding: 5px 10px;
            font-size: 16px;
            border: none;
            border-radius: 30px;
            width: 100%;
            max-width: 300px;
            background-color: #d9edff;
        }
        .profile-icon {
            margin-left: 15px;
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .top {
            background-color:#6397b5;
            color: white;
            padding: 20px;


            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .top h1 {
            margin: 0;

            text-align: center;
            margin-top:-90px;
            margin-bottom: 30px;
            margin-left: 150px;

        }


        main {
            padding: 30px;
            max-width: 600px;
            padding: 30px;
            margin: 40px auto;
            background: #9bbfbe;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input[type="text"],
        input[type="number"],
        textarea,
        select,
        input[type="file"] {
            display: block;
            margin-top: 5px;
            padding: 12px;
            border: 1px solid #333;
            border-radius: 6px;
            font-size: 1rem;
            width: 95%;
            background-color: #b1e3d5;
        }

        textarea {
            resize: vertical;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            font-size: 1rem;
            font-family: inherit; /* Inherit the font from the parent element */
            width: 100%; /* Ensure it has the same width as other input elements */
            box-sizing: border-box; /* Include padding and border in the element's width */

        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .checkbox-group div {
            display: flex;
            align-items: center;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
        }

        button {
            padding: 12px 24px;
            background-color: #0288d1;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1rem;
            align-self: flex-start;
        }

        button:hover {
            background-color: #0277bd;
        }

        .error {
            color: #e57373;
            margin: 5px 0;
        }

        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .menu-icon {
            width: 100px; /* Adjust size as needed */
            height: auto;
            margin: 30px;
            margin-left: 400px

        }
    </style>
</head>

<body>
<header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/restaurant/dashboard'"> <!-- Replace 'logo.png' with your logo image path -->
            <ul>
                <li><a href='/restaurant/menu'>Menu Management</a></li>
                <li><a href="/restaurant/reservations">Reservation Management</a></li>
{{--                <li><a href='/pre-order'>Pre-Order Management</a></li>--}}
                <li><a href='/payment-verification'>Payment Verification</a></li>
                <li><a href='/restaurant/offers'>Offers Management</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <div class="profile-icon" onclick="location.href='/restaurant/profile'">
                <img src="{{ asset('images/restaurant.png') }}" alt="Profile">
            </div>
        </div>
    </header>
    <div class="top">
    <img src="{{ asset('images/add.png') }}" alt="Menu Icon" class="menu-icon">
       <h1> Add New Menu Item </h1>
    </div>
    <main>
        <form id="menuForm" action="{{ route('restaurant.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price (Rs.):</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                @error('price')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category[]" multiple required>
                    <option value="Starter" {{ in_array('Starter', old('category', [])) ? 'selected' : '' }}>Starter</option>
                    <option value="Main Course" {{ in_array('Main Course', old('category', [])) ? 'selected' : '' }}>Main Course</option>
                    <option value="Dessert" {{ in_array('Dessert', old('category', [])) ? 'selected' : '' }}>Dessert</option>
                    <option value="Beverage" {{ in_array('Beverage', old('category', [])) ? 'selected' : '' }}>Beverage</option>
                    <option value="Other" {{ in_array('Other', old('category', [])) ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                @error('image')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Allergens:</label>
                <div class="checkbox-group">
                    <div>
                        <input type="checkbox" id="allergen1" name="allergens[]" value="Peanuts" {{ in_array('Peanuts', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen1">Peanuts</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen2" name="allergens[]" value="Gluten" {{ in_array('Gluten', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen2">Gluten</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen3" name="allergens[]" value="Dairy" {{ in_array('Dairy', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen3">Dairy</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen4" name="allergens[]" value="Eggs" {{ in_array('Eggs', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen4">Eggs</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen5" name="allergens[]" value="Soy" {{ in_array('Soy', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen5">Soy</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen6" name="allergens[]" value="Tree Nuts" {{ in_array('Tree Nuts', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen6">Tree Nuts</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen7" name="allergens[]" value="Shellfish" {{ in_array('Shellfish', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen7">Shellfish</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen8" name="allergens[]" value="Fish" {{ in_array('Fish', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen8">Fish</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen9" name="allergens[]" value="Wheat" {{ in_array('Wheat', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen9">Wheat</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen10" name="allergens[]" value="Sesame" {{ in_array('Sesame', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen10">Sesame</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen11" name="allergens[]" value="Mustard" {{ in_array('Mustard', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen11">Mustard</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen12" name="allergens[]" value="Sulfites" {{ in_array('Sulfites', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen12">Sulfites</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Lupin" {{ in_array('Lupin', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Lupin</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Celery" {{ in_array('Celery', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Celery</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Molluscs" {{ in_array('Molluscs', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Molluscs</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Corn" {{ in_array(' Corn', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Corn</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Sunflower" {{ in_array('Sunflower', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Sunflower</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Poppy Seeds" {{ in_array(' Poppy Seeds', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Poppy Seeds</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Buckwheat" {{ in_array(' Buckwheat', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Buckwheat</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Latex" {{ in_array(' Latex', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Latex</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen14" name="allergens[]" value="Other" {{ in_array('Other', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen14">Other (Please specify below)</label>
                        <input type="text" id="allergen-other" name="allergen_other" value="{{ old('allergen_other') }}">
                    </div>
                </div>
                @error('allergens')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Dietary Preferences:</label>
                <div class="checkbox-group">
                    <div>
                        <input type="checkbox" id="diet1" name="dietary[]" value="Vegetarian" {{ in_array('Vegetarian', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet1">Vegetarian</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet2" name="dietary[]" value="Vegan" {{ in_array('Vegan', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet2">Vegan</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet3" name="dietary[]" value="Non-Vegetarian" {{ in_array('Non-Vegetarian', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet3">Non-Vegetarian</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet4" name="dietary[]" value="Pescatarian" {{ in_array('Pescatarian', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet4">Pescatarian</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet5" name="dietary[]" value="Gluten-Free" {{ in_array('Gluten-Free', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet5">Gluten-Free</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet6" name="dietary[]" value="Dairy-Free" {{ in_array('Dairy-Free', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet6">Dairy-Free</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet7" name="dietary[]" value="Other" {{ in_array('Other', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet7">Other (Please specify below)</label>
                        <input type="text" id="diet-other" name="diet_other" value="{{ old('diet_other') }}">
                    </div>
                </div>

            <div class="form-group">
                <button type="submit">Add Menu Item</button>
            </div>
            </div>
        </form>
    </main>
</body>

</html>
