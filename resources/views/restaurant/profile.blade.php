<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .profile-container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .profile-image {
            max-width: 200px;
            border-radius: 10px;
        }
        .edit-icon {
            cursor: pointer;
            color: #007bff;
        }
        .edit-icon:hover {
            color: #0056b3;
        }
        .profile-info {
            margin: 20px 0;
            text-align: left;
        }
        .profile-info p {
            font-size: 18px;
            margin: 10px 0;
        }
        .action-buttons {
            margin-top: 20px;
        }
        .action-buttons button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .action-buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h1>Restaurant Profile</h1>
        
        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        @if ($restaurant)
            <img src="{{ $restaurant->image_url }}" alt="Restaurant Image" class="profile-image">
            <h2>{{ $restaurant->name }} <span class="edit-icon" onclick="window.location.href='{{ route('restaurant.profile.edit') }}'">✏️</span></h2>
            <div class="profile-info">
                <p><strong>Description:</strong> {{ $restaurant->description }}</p>
                <p><strong>Contact Number:</strong> {{ $restaurant->contact_number }}</p>
                <p><strong>Address:</strong> {{ $restaurant->address }}</p>
                <p><strong>Cuisine Type:</strong> {{ implode(', ', json_decode($restaurant->cuisine_type)) }}</p>
                <p><strong>Email:</strong> {{ $restaurant->email }}</p>
            </div>

            <div class="action-buttons">
                <button onclick="window.location.href='{{ route('restaurant.profile.addToCustomerPage') }}'">Add to Customer Page</button>
                <button onclick="window.location.href='{{ route('restaurant.profile.updateCustomerPage') }}'">Update on Customer Page</button>
            </div>
        @else
            <p>No restaurant profile found. <a href="{{ route('restaurant.profile.edit') }}">Create one now.</a></p>
        @endif

    </div>

</body>
</html>