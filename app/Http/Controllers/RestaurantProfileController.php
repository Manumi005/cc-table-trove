<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class RestaurantProfileController extends Controller
{
    /**
     * Display the restaurant profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Retrieve the currently authenticated restaurant
        $restaurant = Auth::guard('restaurant')->user();
        
        // Return the profile view with the restaurant data
        return view('restaurant.profile', compact('restaurant'));
    }

    /**
     * Show the form for editing the restaurant profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Retrieve the currently authenticated restaurant
        $restaurant = Auth::guard('restaurant')->user();
        
        // Return the edit view with the restaurant data
        return view('restaurant.profile-edit', compact('restaurant'));
    }

    /**
     * Update the restaurant profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
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
    
        // Retrieve the currently authenticated restaurant
        $restaurant = Auth::guard('restaurant')->user();
    
        // Update the restaurant details
        $restaurant->name = $request->input('name');
        $restaurant->email = $request->input('email');
        $restaurant->contact_number = $request->input('contact_number');
        $restaurant->address = $request->input('address');
        
        // Default cuisine_type to an empty array if null
        $cuisineType = $request->input('cuisine_type', []);
        $restaurant->cuisine_type = json_encode($cuisineType);
    
        $restaurant->opening_hours_start = $request->input('opening_hours_start');
        $restaurant->opening_hours_end = $request->input('opening_hours_end');
        $restaurant->details = $request->input('details');
    
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($restaurant->image && Storage::exists($restaurant->image)) {
                Storage::delete($restaurant->image);
            }
    
            // Store the new image and update the restaurant record
            $path = $request->file('image')->store('public/restaurant_images');
            $restaurant->image = $path;
        }
    
        // Save the restaurant details
        $restaurant->save();
    
        // Redirect back to the profile with a success message
        return redirect()->route('restaurant.profile.show')->with('success', 'Profile updated successfully.');
    }
}    