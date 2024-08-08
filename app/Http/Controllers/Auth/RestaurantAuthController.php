<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RestaurantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.restaurant-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('restaurant')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/restaurant/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showRegistrationForm()
    {
        return view('auth.restaurant-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:restaurants',
            'contact_number' => 'required|string|min:10|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $restaurant = Restaurant::create([
            'restaurant_name' => $request->restaurant_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'cuisine_type' => $request->cuisine_type,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('restaurant')->login($restaurant);

        return redirect('/restaurant/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('restaurant')->logout();
        return redirect('/');
    }
}
