<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class RestaurantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.restaurant-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('restaurant')->attempt($credentials)) {
            return redirect()->intended('restaurant/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.restaurant-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'cuisine_type' => 'nullable|array',
            'cuisine_type.*' => 'string',
            'password' => 'required|confirmed|min:6',
        ]);

        Restaurant::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'cuisine_type' => json_encode($request->cuisine_type),
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('restaurant.login')->with('success', 'Registration successful! Please log in.');
    }

    public function logout()
    {
        Auth::guard('restaurant')->logout();
        return redirect()->route('restaurant.login');
    }
}
