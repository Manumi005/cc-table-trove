<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Restaurant;

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
        $offers = Offer::all(); // Or however you are retrieving the offers
        return view('restaurant.offers.index', compact('offers'));
    }

    // Show the form for creating a new offer
    public function create()
    {
        return view('restaurant.offers.create');
    }

    // Store a newly created offer in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('offers', 'public');
        }

        Offer::create($validatedData);

        return redirect()->route('customer.offers.index')->with('success', 'Offer created successfully!');
    }

    // Show the form for editing the specified offer
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        return view('offers.edit', compact('offer'));
    }

    // Update the specified offer in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'image' => 'nullable|image|max:2048',
        ]);

        $offer = Offer::findOrFail($id);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('offers', 'public');
        }

        $offer->update($validatedData);

        return redirect()->route('customer.offers.index')->with('success', 'Offer updated successfully!');
    }

    // Remove the specified offer from storage
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return redirect()->route('customer.offers.index')->with('success', 'Offer deleted successfully!');
    }
}
