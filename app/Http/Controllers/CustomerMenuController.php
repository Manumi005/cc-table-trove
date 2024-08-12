<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CustomerMenuController extends Controller
{
    public function show($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $menus = Menu::where('restaurant_id', $restaurantId)->get();
        return view('customer.menu.index', compact('restaurant', 'menus'));
    }
}
