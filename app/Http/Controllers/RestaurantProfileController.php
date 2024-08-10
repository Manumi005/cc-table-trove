<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class RestaurantProfileController extends Controller
{
    // Show the restaurant profile
    public function show()
    {
        $restaurant = Auth::guard('restaurant')->user(); // Get the authenticated restaurant
        return view('restaurant.profile', compact('restaurant'));
    }

    // Show the edit form
    public function edit()
    {
        $restaurant = Auth::guard('restaurant')->user(); // Get the authenticated restaurant
        return view('restaurant.edit-profile', [
            'restaurant' => $restaurant,
            'editing' => true // Pass a flag to indicate editing mode
        ]);
    }

    // Update the restaurant profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email,' . Auth::id(),
            'contact_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'nullable|array',
            'cuisine_type.*' => 'string',
            'profile_image' => 'nullable|image|max:2048' // Validation for image file
        ]);

        $restaurant = Auth::guard('restaurant')->user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'cuisine_type' => json_encode($request->cuisine_type),
        ];

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            // Delete the old image if exists
            if ($restaurant->profile_image && Storage::exists($restaurant->profile_image)) {
                Storage::delete($restaurant->profile_image);
            }

            // Store the new image
            $path = $request->file('profile_image')->store('public/restaurants');
            $data['profile_image'] = $path;
        }

        $restaurant->update($data);

        return redirect()->route('restaurant.profile.show')->with('success', 'Profile updated successfully!');
    }
}
