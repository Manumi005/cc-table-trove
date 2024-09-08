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


        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:20',
            'allergies' => 'nullable|array',
            'preferences' => 'nullable|array',
        ]);

        // Fetch the authenticated user
        $user = Auth::user();

        // Update user profile data
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'allergies' => $request->input('allergies', []),
            'preferences' => $request->input('preferences', []),
        ]);

        // Redirect back with success message
        return redirect()->route('customer.profile.show')->with('success', 'Profile updated successfully');
    }
}
