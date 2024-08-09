<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Profile</title>
</head>
<body>

    <h1>Edit Restaurant Profile</h1>

    <form action="{{ route('restaurant.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Contact Number -->
        <div>
            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number', $restaurant->contact_number) }}">
        </div>

        <!-- Address -->
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
        </div>

        <!-- Cuisine Type -->
        <div>
            <label for="cuisine_type">Cuisine Type:</label>
            <select id="cuisine_type" name="cuisine_type[]" multiple required>
                @php
                    // Decode the JSON value and ensure it's an array
                    $cuisineTypes = json_decode($restaurant->cuisine_type, true) ?? [];
                @endphp
                <option value="Italian" {{ in_array('Italian', $cuisineTypes) ? 'selected' : '' }}>Italian</option>
                <option value="Chinese" {{ in_array('Chinese', $cuisineTypes) ? 'selected' : '' }}>Chinese</option>
                <option value="Sri Lankan" {{ in_array('Sri Lankan', $cuisineTypes) ? 'selected' : '' }}>Sri Lankan</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $restaurant->email) }}" required>
        </div>

        <!-- Restaurant Image -->
        <div>
            <label for="image">Restaurant Image:</label>
            <input type="file" id="image" name="image">
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit">Save Changes</button>
        </div>
    </form>

</body>
</html>
