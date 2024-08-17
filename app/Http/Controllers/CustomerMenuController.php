<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerMenuController extends Controller
{
    // Show the menu page with menu items for a specific restaurant
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

    // Filter menu items based on the selected criteria
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

        Log::info('Filter request received', [
            'restaurantId' => $restaurantId,
            'allergies' => $allergies,
            'dietaryPreferences' => $dietaryPreferences,
            'priceRange' => $priceRange
        ]);

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

        Log::info('Filtered menus', ['menus' => $menus]);

        return response()->json($menus);
    }
}