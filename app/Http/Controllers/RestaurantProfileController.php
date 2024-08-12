<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantProfileController extends Controller
{
    public function show()
    {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.profile', compact('restaurant'));
    }

    public function edit()
    {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.profile-edit', compact('restaurant'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'nullable|array',
            'cuisine_type.*' => 'string',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $restaurant = Auth::guard('restaurant')->user();
        $restaurant->name = $request->input('name');
        $restaurant->email = $request->input('email');
        $restaurant->contact_number = $request->input('contact_number');
        $restaurant->address = $request->input('address');
        
        $cuisineType = $request->input('cuisine_type', []);
        $restaurant->cuisine_type = json_encode($cuisineType);

        $restaurant->opening_hours_start = $request->input('opening_hours_start');
        $restaurant->opening_hours_end = $request->input('opening_hours_end');
        $restaurant->details = $request->input('details');

        if ($request->hasFile('image')) {
            if ($restaurant->image && Storage::exists($restaurant->image)) {
                Storage::delete($restaurant->image);
            }
            $path = $request->file('image')->store('public/restaurant_images');
            $restaurant->image = $path;
        }

        $restaurant->save();
        return redirect()->route('restaurant.profile.show')->with('success', 'Profile updated successfully.');
    }

    public function showSummary()
    {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.summary', compact('restaurant'));
    }

    public function showRestaurantDetails($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('customer.restaurant-details', compact('restaurant'));
    }

    public function create()
    {
        return view('restaurant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:restaurants',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'nullable|array',
            'cuisine_type.*' => 'string',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        $restaurant->email = $request->input('email');
        $restaurant->contact_number = $request->input('contact_number');
        $restaurant->address = $request->input('address');
        
        $cuisineType = $request->input('cuisine_type', []);
        $restaurant->cuisine_type = json_encode($cuisineType);

        $restaurant->opening_hours_start = $request->input('opening_hours_start');
        $restaurant->opening_hours_end = $request->input('opening_hours_end');
        $restaurant->details = $request->input('details');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/restaurant_images');
            $restaurant->image = $path;
        }

        $restaurant->save();
        return redirect()->route('restaurant.summary')->with('success', 'Restaurant created successfully.');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        if ($restaurant->image && Storage::exists($restaurant->image)) {
            Storage::delete($restaurant->image);
        }
        $restaurant->delete();
        return redirect()->route('restaurant.dashboard')->with('success', 'Restaurant deleted successfully.');
    }
}
