<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CustomerMenuController extends Controller
{
    // Show the menu page with menu items for a specific restaurant
    public function show($restaurantId): View
    {
        $restaurantId = (int) $restaurantId;
        $restaurant = Restaurant::findOrFail($restaurantId);
        $menus = Menu::where('restaurant_id', $restaurantId)->get();

        $user = Auth::user();
        $userAllergens = $user ? explode(',', $user->allergens) : [];

        foreach ($menus as $menu) {
            $menu->allergens = explode(',', $menu->allergens);
            $menu->dietary_preferences = explode(',', $menu->dietary_preferences);
        }

        return view('customer.menu.index', compact('restaurant', 'menus', 'userAllergens'));
    }

    // Filter menu items based on the selected criteria
    public function filter(Request $request)
    {
        $validated = $request->validate([
            'restaurantId' => 'required|integer|exists:restaurants,id',
            'allergies' => 'array',
            'allergies.*' => 'string',
            'dietary' => 'array',
            'dietary.*' => 'string',
            'priceRange' => 'nullable|numeric|min:1000|max:10000'
        ]);

        $restaurantId = $validated['restaurantId'];
        $allergies = $validated['allergies'] ?? [];
        $dietary = $validated['dietary'] ?? [];
        $priceRange = $validated['priceRange'] ?? 10000;

        Log::info('Filter request received', [
            'restaurantId' => $restaurantId,
            'allergies' => $allergies,
            'dietary' => $dietary,
            'priceRange' => $priceRange
        ]);

        $query = Menu::where('restaurant_id', $restaurantId);

        if (!empty($allergies)) {
            $query->where(function ($q) use ($allergies) {
                foreach ($allergies as $allergy) {
                    $q->where('allergens', 'not like', '%' . $allergy . '%');
                }
            });
        }

        if (!empty($dietary)) {
            $query->where(function ($q) use ($dietary) {
                foreach ($dietary as $preference) {
                    $q->where('dietary_preferences', 'like', '%' . $preference . '%');
                }
            });
        }

        $query->whereBetween('price', [1000, $priceRange]);

        $menus = $query->get();

        foreach ($menus as $menu) {
            $menu->allergens = explode(',', $menu->allergens);
            $menu->dietary_preferences = explode(',', $menu->dietary_preferences);
        }

        Log::info('Filtered menus', ['menus' => $menus]);

        return response()->json($menus);
    }

    // Show the order menu page for a specific restaurant
    public function orderMenu($restaurantId)
    {
        $restaurantId = (int) $restaurantId;
        $restaurant = Restaurant::findOrFail($restaurantId);
        $menus = Menu::where('restaurant_id', $restaurantId)->get();

        $user = Auth::user();
        $userAllergens = $user ? explode(',', $user->allergens) : [];

        foreach ($menus as $menu) {
            $menu->allergens = explode(',', $menu->allergens);
            $menu->dietary_preferences = explode(',', $menu->dietary_preferences);
        }

        return view('customer.menu.ordermenu', compact('restaurant', 'menus', 'userAllergens'));

    }
}
