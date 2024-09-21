<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #98b2b8;
            margin: 0;
            padding: 0;
            color: #333;
        }
        /* Navbar Styles */
        nav {
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            height: 60px;
        }
        nav img.logo {
            cursor: pointer;
            width: 150px;
            height: auto;
        }
        .slider {
            width: 100%;
            overflow: hidden;
        }
        .slide {
            display: none;
        }
        .slide img {
            width: 100%;
            height: 400px;
        }
        .slide.active {
            display: block;
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
            cursor: pointer;
        }
        .profile-icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
        }
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
            padding: 0 20px;
            justify-content: center;
            margin-bottom: 50px;
        }
        .card {
            background-color: #d9edff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            width: 200px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            margin-top: 0;
            color: #1b8094;
            margin-bottom: 15px;
        }
        .card p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            position: absolute;
            bottom: 20px;
        }
        .card img {
            width: 40%;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .search-bar {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="/restaurant/dashboard">
        <img src="{{ asset('images/logo.png') }}" alt="Restaurant Logo" class="logo">
        </a>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        <a href="/restaurant/profile" class="profile-icon">
            <img src="{{ asset('images/restaurant.png') }}" alt="Profile">
        </a>
    </nav>

    <!-- Slider -->
    <section class="slider">
        <div class="slide active">
            <img src="{{ asset('images/1.png') }}" alt="Offer 1">
        </div>
        <div class="slide">
            <img src="{{ asset('images/2.png') }}" alt="Offer 2">
        </div>

    </section>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <h1>Welcome to Your Restaurant's Dashboard!</h1>

        <!-- Cards Container -->
        <div class="cards-container">
            <!-- Profile Management Card -->
            <div class="card" onclick="location.href='/restaurant/profile'">
                <img src="{{ asset('images/restaurant.png') }}" alt="Profile Management">
                <h3>Profile Management</h3>
                <p>Manage and update your restaurant's profile, including contact details and opening hours.</p>
            </div>

            <!-- Menu Management Card -->
            <div class="card" onclick="location.href='/restaurant/menu'">
                <img src="{{ asset('images/restaurantmenu.png') }}" alt="Menu Management">
                <h3>Menu Management</h3>
                <p>Create, edit, and organize your restaurant's menu items with ease.</p>
            </div>

            <!-- Reservation Management Card -->
            <div class="card" onclick="location.href='/restaurant/reservations'">
                <img src="{{ asset('images/restaurantreservation.png') }}" alt="Reservation Management">
                <h3>Reservation Management</h3>
                <p>Handle customer reservations efficiently with our intuitive tools.</p>
            </div>

{{--            <!-- Preorder Management Card -->--}}
{{--            <div class="card" onclick="location.href='{{ route('preorder.summary') }}'">--}}
{{--                <img src="{{ asset('images/restaurantpreorder.png') }}" alt="Preorder Management">--}}
{{--                <h3>Preorder Management</h3>--}}
{{--                <p>Manage and process customer preorders seamlessly.</p>--}}
{{--            </div>--}}

             <!-- Payment Verification Card -->
             <div class="card" onclick="location.href='{{ route('restaurant.payment') }}'">
                <img src="{{ asset('images/restaurantpayment.png') }}" alt="Payment Verification">
                <h3>Payment Verification</h3>
                <p>Ensure secure and verified transactions for all customer payments.</p>
            </div>

            <!-- Offers Management Card -->
            <div class="card" onclick="location.href='/restaurant/offers'">
                <img src="{{ asset('images/offersnpromos.png') }}" alt="Offers Management">
                <h3>Offers Management</h3>
                <p>Create and manage special offers to attract more customers to your restaurant.</p>
            </div>
    </div>

    <!-- JavaScript for Slider -->
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        // Show the first slide initially
        showSlide(currentSlide);
        // Automatically switch slides every 5 seconds
        setInterval(nextSlide, 5000);
    </script>

</body>
</html>
