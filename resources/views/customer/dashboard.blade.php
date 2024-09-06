<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #cd9cc0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav img {
            cursor: pointer;
            width: 150px; /* Adjust size as needed */
            height: 60px;
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
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
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

        .slider {
            width: 100%;
            overflow: hidden;
        }

        .slide {
            display: none;
        }

        .slide img {
            width: 100%;
            height: 500px;
        }

        .horizontal-scroll {
            display: flex;
            overflow-x: auto;
            padding: 20px;
            background-color: #545353;
        }

        .card {
            display: inline-block;
            margin: 10px;
            padding: 10px;
            background-color: #bdffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 250px;
            flex: 0 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .card h3, .card h4 {
            margin: 10px 0;
        }

        .card button {
            margin: 5px;
            padding: 10px;
            background-color: #8d8fcb;
            color: #fff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background-color: #7c347d;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(2, 2, 2, 0.8);
        }

        .categories-section {
            background-color: #f9b6da;
            padding: 20px;
            text-align: center;
        }

        .categories-section a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .categories-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .categories-grid .card {
            width: calc(23.33% - 20px);
            margin: 10px;
        }

        @media (max-width: 768px) {
            .categories-grid .card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .categories-grid .card {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
            <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="/customer/reservations">Reservations</a></li>
                <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <div class="profile-icon" onclick="location.href='/customer/profile'">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
            </div>
        </div>
    </header>

    <section class="slider">
        <div class="slide">
            <img src="{{ asset('images/offers1.png') }}" alt="Offer 1">
        </div>
        <div class="slide">
            <img src="{{ asset('images/offer2.png') }}" alt="Offer 2">
        </div>
        <div class="slide">
            <img src="{{ asset('images/offer3.png') }}" alt="Offer 3">
        </div>
    </section>

    <section class="recommended-restaurants">
        <h2>Recommended Restaurants</h2>
        <div class="horizontal-scroll">
            <div class="card">
                <img src="{{ asset('images/itarest.jpg') }}" alt="Italian Restaurant">
                <h3>Trattoria Del Corso</h3>
                <button>More Info</button>
                <button>View Menus</button>
            </div>
            <div class="card">
                <img src="{{ asset('images/srires.jpg') }}" alt="Sri Lankan Restaurant">
                <h3>Manumi's Kitchen</h3>
                <button>More Info</button>
                <button>View Menus</button>
            </div>
            <div class="card">
                <img src="{{ asset('images/mexrest.jpeg') }}" alt="Mexican Restaurant">
                <h3>Tacos and Tequila</h3>
                <button>More Info</button>
                <button>View Menus</button>
            </div>
            <div class="card">
                <img src="{{ asset('images/indres.jpg') }}" alt="Indian Restaurant">
                <h3>Mother India</h3>
                <button>More Info</button>
                <button>View Menus</button>
            </div>
            <div class="card">
                <img src="{{ asset('images/chirest.jpg') }}" alt="Chinese Restaurant">
                <h3>Orient Chinese Restaurant</h3>
                <button>More Info</button>
                <button>View Menus</button>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <h2>Categories</h2>
        <div class="categories-grid">
            <div class="card">
                <img src="{{ asset('images/italiancat.jpg') }}" alt="Italian">
                <h4><a href="#">Italian</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/chinesecat.jpg') }}" alt="Chinese">
                <h4><a href="#">Chinese</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/mexicancat.jpg') }}" alt="Mexican">
                <h4><a href="#">Mexican</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/indiancat.jpg') }}" alt="Indian">
                <h4><a href="#">Indian</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/srilankancat.jpeg') }}" alt="Sri Lankan">
                <h4><a href="#">Sri Lankan</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/thaicat.jpg') }}" alt="Thai">
                <h4><a href="#">Thai</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/koreancat.jpg') }}" alt="Korean">
                <h4><a href="#">Korean</a></h4>
            </div>
            <div class="card">
                <img src="{{ asset('images/japcat.jpg') }}" alt="Japanese">
                <h4><a href="#">Japanese</a></h4>
            </div>
        </div>
    </section>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.querySelectorAll('.slide');
            slides.forEach((slide, index) => {
                slide.style.display = 'none';
            });
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1; }
            slides[slideIndex - 1].style.display = 'block';
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
</body>
</html>

