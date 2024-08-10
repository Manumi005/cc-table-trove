<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #D8BFD8; /* Light Purple background */
            color: #fff;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        .profile-pic-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 20px auto;
        }
        .profile-pic {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }
        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
        }
        .edit-icon input {
            display: none;
        }
        .edit-icon img {
            width: 30px;
            height: 30px;
        }
        .form-group label {
            color: #333;
        }
        .btn-primary {
            background-color: #6A0DAD;
            border-color: #6A0DAD;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #5a0b9c;
            border-color: #5a0b9c;
        }
        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(106, 13, 173, 0.5);
        }

        /* Slider styles */
        .slider {
            position: relative;
            max-width: 100%;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        }
        .slide {
            display: none;
        }
        .slide img {
            width: 100%;
            height: auto;
        }
        .active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Restaurant Profile</h1>

        <div class="profile-pic-container">
            <img src="{{ $restaurant->profile_image ? Storage::url($restaurant->profile_image) : asset('images/OceanVila.jpg') }}" alt="Profile Image" id="profilePreview" class="profile-pic">
            <div class="edit-icon">
                <label for="profile_image">
                    <img src="{{ asset('images/camera.jpg') }}" alt="Camera Icon">
                </label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewProfileImage(event)">
            </div>
        </div>

        <form action="{{ route('restaurant.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Restaurant Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $restaurant->email) }}" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $restaurant->contact_number) }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
            </div>

            <div class="form-group">
                <label for="cuisine_type">Cuisine Type</label>
                <select name="cuisine_type[]" id="cuisine_type" class="form-control" multiple required>
                    @php
                        $cuisines = ['Italian', 'Chinese', 'Sri Lankan']; // Add more as needed
                        $selectedCuisines = json_decode($restaurant->cuisine_type, true) ?? [];
                    @endphp
                    @foreach($cuisines as $cuisine)
                        <option value="{{ $cuisine }}" {{ in_array($cuisine, $selectedCuisines) ? 'selected' : '' }}>
                            {{ $cuisine }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function previewProfileImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profilePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 3000); // Change slide every 3 seconds
    </script>
</body>
</html>
