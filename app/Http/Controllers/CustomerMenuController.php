<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // For accessing the authenticated user

class CustomerMenuController extends Controller
{
    public function show($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $menus = Menu::where('restaurant_id', $restaurantId)->get();

        // Fetch the currently logged-in user
        $user = Auth::user();
        // Assuming the user's allergens are stored in the 'allergens' attribute of the user model
        $userAllergens = $user ? explode(',', $user->allergens) : [];

        return view('customer.menu.index', compact('restaurant', 'menus', 'userAllergens'));
    }
}
