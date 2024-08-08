<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        $allergyOptions = ['Peanuts', 'Milk', 'Eggs', 'Shellfish', 'Soy', 'Wheat', 'Fish', 'Tree nuts', 'Sesame', 'Other'];
        $preferenceOptions = ['Vegetarian', 'Vegan', 'Gluten-Free', 'Dairy-Free', 'Halal', 'Kosher', 'Paleo', 'Keto', 'Other'];

        return view('customer.profile', compact('user', 'profile', 'allergyOptions', 'preferenceOptions'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'contact_number' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'allergies' => 'nullable|array',
            'preferences' => 'nullable|array',
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update profile details
        $profile->contact_number = $request->contact_number;

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                \Storage::disk('public')->delete($profile->profile_image);
            }
            $profile->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }

        $profile->allergies = $request->allergies ?? [];
        $profile->preferences = $request->preferences ?? [];

        $profile->save();

        return redirect()->route('customer.profile.show')->with('success', 'Profile updated successfully');
    }
}
