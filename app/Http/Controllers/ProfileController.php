<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        // Fetch the authenticated user
        $user = Auth::user();
        
        // Return the profile view with user data
        return view('customer.profile', compact('user'));
    }

    public function edit()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Return the edit profile view with user data
        return view('customer.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Validate and update user profile data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:15',
            'allergies' => 'nullable|array',
            'preferences' => 'nullable|array',
        ]);
    
        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'allergies' => $request->allergies,
            'preferences' => $request->preferences,
        ]);
    
        return redirect()->route('customer.profile.show')->with('success', 'Profile updated successfully.');
    }
}