<?php

namespace App\Http\Controllers;

use App\Models\Customization; // Import the Customization model
use App\Models\Reservation; // Import the Reservation model
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        // Fetch all customizations with their related reservation data
        $customizations = Customization::with('reservation')->get();

        return view('customer.customizations.index', compact('customizations'));
    }

    public function create()
    {
        // Fetch reservations for selection in the customization creation form
        $reservations = Reservation::all(); // Adjust query as needed
        return view('customer.customizations.create', compact('reservations'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'customizations' => 'array',
            'special_occasion' => 'array',
            'table_location' => 'nullable|string',
            'additional_requests' => 'nullable|string',
        ]);

        // Store the customization
        Customization::create([
            'reservation_id' => $validated['reservation_id'],
            'customizations' => json_encode($validated['customizations'] ?? []),
            'special_occasion' => json_encode($validated['special_occasion'] ?? []),
            'table_location' => $validated['table_location'],
            'additional_requests' => $validated['additional_requests'],
        ]);

        // Redirect to the customizations index page or a success page
        return redirect()->route('customer.customizations.index')
            ->with('success', 'Customization created successfully.');
    }

    public function edit($id)
    {
        $customization = Customization::findOrFail($id);
        $reservations = Reservation::all(); // Adjust query as needed
        return view('customer.customizations.edit', compact('customization', 'reservations'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'customizations' => 'array',
            'special_occasion' => 'array',
            'table_location' => 'nullable|string',
            'additional_requests' => 'nullable|string',
        ]);

        // Update the customization entry
        $customization = Customization::findOrFail($id);
        $customization->reservation_id = $validated['reservation_id'];
        $customization->customizations = json_encode($validated['customizations'] ?? []);
        $customization->special_occasion = json_encode($validated['special_occasion'] ?? []);
        $customization->table_location = $validated['table_location'];
        $customization->additional_requests = $validated['additional_requests'];
        $customization->save();

        return redirect()->route('customer.customizations.index')
            ->with('success', 'Customization updated successfully.');
    }

    public function destroy($id)
    {
        $customization = Customization::findOrFail($id);
        $customization->delete();

        return redirect()->route('customer.customizations.index')
            ->with('success', 'Customization deleted successfully.');
    }

    public function restaurantCustomizations()
    {
        // Fetch all customizations with their related reservation data for restaurant view
        $customizations = Customization::with('reservation')->get();

        return view('restaurant.customizations', compact('customizations'));
    }
}
