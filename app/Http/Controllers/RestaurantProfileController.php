<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantProfileController extends Controller
{
    /**
     * Show the form for editing the restaurant profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $restaurant = Auth::user()->restaurant;
        return view('restaurant.edit-profile', compact('restaurant'));
    }

    /**
     * Update the restaurant profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'contact_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'required|array',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload validation
        ]);

        $restaurant = Auth::user()->restaurant;

        // Update restaurant fields
        $restaurant->contact_number = $request->input('contact_number');
        $restaurant->address = $request->input('address');
        $restaurant->cuisine_type = json_encode($request->input('cuisine_type')); // Encode the array as JSON
        $restaurant->email = $request->input('email');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($restaurant->image && Storage::exists($restaurant->image)) {
                Storage::delete($restaurant->image);
            }

            // Store the new image
            $path = $request->file('image')->store('restaurant_images', 'public');
            $restaurant->image = $path;
        }

        // Save the updated restaurant profile
        $restaurant->save();

        // Redirect back with a success message
        return redirect()->route('restaurant.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
