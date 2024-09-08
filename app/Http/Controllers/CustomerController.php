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
    public function listRestaurants(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $restaurants = Restaurant::where('name', 'like', "%{$query}%")
                ->orWhere('details', 'like', "%{$query}%")
                ->get();
        } else {
            $restaurants = Restaurant::all();
        }

        return view('customer.restaurant', ['restaurants' => $restaurants]); // Use the correct view path
    }

    /**
     * Display the details of a specific restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('customer.restaurant-details', ['restaurant' => $restaurant]);
    }
}
