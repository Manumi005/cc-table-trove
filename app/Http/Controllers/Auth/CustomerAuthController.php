<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer; // Ensure this is correctly included
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.customer-login');
    }

    /**
     * Handle a login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the customer
        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            // Redirect to intended route or default dashboard route
            return redirect()->intended(route('customer.dashboard'));
        }

        // If login fails, redirect back with an error message
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.customer-register');
    }

    /**
     * Handle a registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'contact_number' => 'required|string|min:10|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new customer and log them in
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'password' => Hash::make($request->password),
        ]);

        // Log in the customer
        Auth::guard('customer')->login($customer);

        // Redirect to the customer dashboard
        return redirect()->route('customer.dashboard');
    }

    /**
     * Handle a logout request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        // Redirect to the home page
        return redirect('/');
    }

    /**
     * Show the customer dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('customer.dashboard');
    }
}
