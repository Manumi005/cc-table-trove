<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Customer;

class ProfileController extends Controller
{
    public function show()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Get the profile image URL if available
        $imageUrl = $user->image ? Storage::url($user->image) : null;

        // Return the profile view with user data and image URL
        return view('customer.profile', compact('user', 'imageUrl'));
    }

    public function edit()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Get the profile image URL if available
        $imageUrl = $user->image ? Storage::url($user->image) : null;

        // Return the edit profile view with user data and image URL
        return view('customer.edit_profile', compact('user', 'imageUrl'));
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:20',
            'allergens' => 'nullable|array',
            'dietary' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);

        // Fetch the authenticated user
        $user = Auth::user();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::delete($user->image);
            }

            // Store the new image and get its path
            $imagePath = $request->file('image')->store('profile_images', 'public'); // Store image in 'storage/app/public/profile_images'

            // Update user's profile image path
            $user->image = $imagePath;
        }

        // Update user profile data
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'allergens' => $request->input('allergens', []),
            'dietary' => $request->input('dietary', []),
        ]);

        // Save image path if changed
        if (isset($imagePath)) {
            $user->image = $imagePath;
            $user->save();
        }

        // Redirect back with success message
        return redirect()->route('customer.profile.show')->with('success', 'Profile updated successfully');
    }
}
