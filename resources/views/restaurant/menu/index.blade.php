<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #b0c7d4;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/wallpaper1.jpg') }}') no-repeat center center fixed;

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
            font-size: 2.5rem;
            text-align: center;
            margin-top:-90px;
            margin-bottom: 30px;
            margin-left: 150px;
        }

        main a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;

            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        main a:hover {
            background-color: #45a049;
        }

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;


        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        .container li {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #c0dae2; /* White background for a clean look */
    border-radius: 15px; /* Rounded corners for a modern feel */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    display: flex;
    color: #333333; /* Dark text color for better readability */
    align-items: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    border-left: 8px solid #6397b5; /* Accent border on the left */
}

.container li:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
}

img {
    border-radius: 15px; /* Same radius as the card for consistency */
    margin-right: 20px;
    width: 250px;
    height: 250px;
}

h2 {
    margin: 0 0 10px;
    font-size: 1.6rem;
    color: #374151;
    font-weight: bold; /* Make the heading bold */
}

.item p {
    margin: 0 0 10px;
    font-size: 1rem;
    color: #333333; /* Darker color for better readability */
    font-weight: bold; /* Make the labels bold */
    line-height: 1.5;
}

.item p span {
    font-weight: normal; /* Make the values normal weight */
    color: #6B7280; /* Slightly lighter color for the values */
}
.item a {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    margin-right: 15px;
    padding: 8px 12px;
    border-radius: 5px;
    background-color: #6397b5; /* Consistent color with header */
    transition: background-color 0.3s ease, color 0.3s ease;
    display: inline-block;
    text-align: center;
}

.item a:hover {
    background-color: #467a91; /* Darken on hover */
    text-decoration: none;
}

form button {
    padding: 8px 15px;
    background-color: #FF5C5C;
    color: white;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    margin-top: 10px; /* Space between Edit link and Delete button */
}

form button:hover {
    background-color: #d94444; /* Darken delete button on hover */
}

form {
    display: inline;
}

.menu-icon {
    width: 80px; /* Adjust size as needed */
    height: auto;
    margin: 30px;
   margin-left: 400px

}
    </style>
</head>

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

    <body>
    <div class="top">
        <img src="{{ asset('images/restaurantmenu.png') }}" alt="Menu Icon" class="menu-icon">
        <h1>Manage Your Menu</h1>
    </div>
    <main>
        <a href="{{ route('restaurant.menu.create') }}">Add New Menu Item</a>
        <ul>
            <div class="container">
                @foreach($menus as $menu)
                    <li>
                        <img src="{{ $menu->image ? asset('storage/' . $menu->image) : '' }}" alt="{{ $menu->name }}">
                        <div class="item">
                            <h2>{{ $menu->name }}</h2>
                            <p>Description: <span>{{ $menu->description }}</span></p>
                            <p>Price: <span>Rs.{{ number_format($menu->price, 2) }}</span></p>
                            <p>Category:
                                        <span>
                                            {{
                                                is_array(json_decode($menu->category))
                                                ? implode(', ', array_filter(json_decode($menu->category)))
                                                : ($menu->category ?: 'N/A')
                                            }}
                                        </span>
                                    </p>
                                    <p>Allergens:
                                        <span>
                                            {{
                                                is_array(json_decode($menu->allergens))
                                                ? implode(', ', array_filter(json_decode($menu->allergens)))
                                                : ($menu->allergens ?: 'N/A')
                                            }}
                                        </span>
                                    </p>
<p>Dietary:
    <span>
        {{
            is_array(json_decode($menu->dietary))
            ? implode(', ', array_filter(json_decode($menu->dietary)))
            : ($menu->dietary ?: 'N/A')
        }}
    </span>
</p>
                        </p>
                            <a href="{{ route('restaurant.menu.edit', $menu->id) }}">Edit</a>
                            <form action="{{ route('restaurant.menu.destroy', $menu->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </div>
        </ul>
    </main>
</body>
</html>
