<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    // Method for listing all offers (customer view)
    public function customerIndex()
    {
        $offers = Offer::all(); // Retrieve all offers for customers
        return view('customer.offers.index', compact('offers'));
    }

    // Method for listing restaurant-specific offers (restaurant view)
    public function restaurantIndex()
    {
        // Ensure the user is authenticated
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('login')->withErrors('Please login to access this page.');
        }

        $restaurantId = Auth::guard('restaurant')->id();
        $offers = Offer::where('restaurant_id', $restaurantId)->get();

        return view('restaurant.offers.index', compact('offers'));
    }

    // Show the form for creating a new offer
    public function create()
    {
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('login')->withErrors('Please login to access this page.');
        }

        return view('restaurant.offers.create');
    }

    // Store a newly created offer in storage
    public function store(Request $request)
    {
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('login')->withErrors('Please login to access this page.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'image' => 'nullable|image|max:2048',
        ]);

        $validatedData['restaurant_id'] = Auth::guard('restaurant')->id();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('offers', 'public');
        }

        Offer::create($validatedData);

        return redirect()->route('restaurant.offers.index')->with('success', 'Offer created successfully!');
    }

    // Show the form for editing the specified offer
    public function edit($id)
    {
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('login')->withErrors('Please login to access this page.');
        }

        $offer = Offer::findOrFail($id);
        $this->authorize('update', $offer);

        return view('restaurant.offers.edit', compact('offer'));
    }

    // Update the specified offer in storage
    public function update(Request $request, $id)
    {
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('login')->withErrors('Please login to access this page.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'image' => 'nullable|image|max:2048',
        ]);

        $offer = Offer::findOrFail($id);
        $this->authorize('update', $offer);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('offers', 'public');
        }

        $offer->update($validatedData);

        return redirect()->route('restaurant.offers.index')->with('success', 'Offer updated successfully!');
    }

    // Remove the specified offer from storage
    public function destroy($id)
    {
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('login')->withErrors('Please login to access this page.');
        }

        $offer = Offer::findOrFail($id);
        $this->authorize('delete', $offer);

        $offer->delete();

        return redirect()->route('restaurant.offers.index')->with('success', 'Offer deleted successfully!');
    }
}
