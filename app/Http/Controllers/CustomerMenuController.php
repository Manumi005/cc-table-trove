<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMenuController extends Controller
{
    public function show($restaurantId)
    {
        // Validate that restaurantId is an integer
        $restaurantId = (int) $restaurantId;
        $restaurant = Restaurant::findOrFail($restaurantId);
        $menus = Menu::where('restaurant_id', $restaurantId)->get();

        $user = Auth::user();
        $userAllergens = $user ? explode(',', $user->allergens) : [];

        return view('customer.menu.index', compact('restaurant', 'menus', 'userAllergens'));
    }

    public function filter(Request $request)
    {
        // Validate and sanitize inputs
        $validated = $request->validate([
            'restaurantId' => 'required|integer|exists:restaurants,id',
            'allergies' => 'array',
            'allergies.*' => 'string',
            'dietaryPreferences' => 'array',
            'dietaryPreferences.*' => 'string',
            'priceRange' => 'nullable|numeric|min:0'
        ]);

        $restaurantId = $validated['restaurantId'];
        $allergies = $validated['allergies'] ?? [];
        $dietaryPreferences = $validated['dietaryPreferences'] ?? [];
        $priceRange = $validated['priceRange'] ?? 1000;

        $query = Menu::where('restaurant_id', $restaurantId);

        // Filter by allergies
        if (!empty($allergies)) {
            $query->where(function ($q) use ($allergies) {
                foreach ($allergies as $allergy) {
                    $q->where('allergens', 'like', '%' . $allergy . '%');
                }
            });
        }

        // Filter by dietary preferences
        if (!empty($dietaryPreferences)) {
            $query->where(function ($q) use ($dietaryPreferences) {
                foreach ($dietaryPreferences as $preference) {
                    $q->where('dietary_preferences', 'like', '%' . $preference . '%');
                }
            });
        }

        // Filter by price range
        $query->where('price', '<=', $priceRange);

        $menus = $query->get();

        return response()->json($menus);
    }
}
