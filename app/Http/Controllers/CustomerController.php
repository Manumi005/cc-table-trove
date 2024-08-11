<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of all restaurants.
     *
     * @return \Illuminate\View\View
     */
    public function listRestaurants()
    {
        $restaurants = Restaurant::all(); // Fetch all restaurants
        return view('customer.restaurant', compact('restaurants')); // Return view with restaurants
    }

    /**
     * Display the details of a specific restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id); // Fetch specific restaurant
        return view('customer.restaurant-details', compact('restaurant')); // Return view with restaurant details
    }
}
