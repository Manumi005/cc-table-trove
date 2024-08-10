<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 800px;
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .profile-image {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .btn-secondary:focus {
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
        }
        .text-center-custom {
            text-align: center;
        }
        h1 {
            font-size: 1.5rem; /* Reduce title size */
        }
        .no-image-message {
            color: #6c757d;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Restaurant Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($restaurant)
            <div class="text-center mb-4">
                @if($restaurant->profile_image && Storage::exists($restaurant->profile_image))
                    <img src="{{ Storage::url($restaurant->profile_image) }}" alt="Restaurant Image" class="profile-image">
                @else
                    <p class="no-image-message">No image available.</p>
                @endif
            </div>

            <div class="form-group">
                <label for="name">Restaurant Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $restaurant->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $restaurant->email }}" disabled>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $restaurant->contact_number }}" disabled>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $restaurant->address }}" disabled>
            </div>

            <div class="form-group">
                <label for="cuisine_type">Cuisine Type</label>
                <input type="text" class="form-control" id="cuisine_type" name="cuisine_type" value="{{ implode(', ', json_decode($restaurant->cuisine_type, true)) }}" disabled>
            </div>

            <div class="text-center">
                <a href="{{ route('restaurant.profile.edit') }}" class="btn btn-secondary">Edit Profile</a>
            </div>
        @else
            <p class="text-center">No restaurant profile found. Create one now.</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
