<?php

namespace App\Http\Controllers;

use App\Models\Customization; // Import the Customization model
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::all();
        return view('customer.customizations.index', compact('customizations'));
    }

    public function create()
    {
        return view('customer.customizations.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'customizations' => 'nullable|array',
            'special_occasion' => 'nullable|array',
            'table_location' => 'nullable|string',
            'additional_requests' => 'nullable|string',
        ]);

        // Create a new customization entry
        $customization = new Customization();
        $customization->customizations = json_encode($validated['customizations'] ?? []);
        $customization->special_occasion = json_encode($validated['special_occasion'] ?? []);
        $customization->table_location = $validated['table_location'] ?? null;
        $customization->additional_requests = $validated['additional_requests'] ?? null;
        $customization->save();

        return redirect()->route('customer.reservations.customizations.index')
            ->with('success', 'Customizations added successfully.');
    }

    public function edit($id)
    {
        $customization = Customization::findOrFail($id);
        return view('customer.customizations.edit', compact('customization'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'customizations' => 'nullable|array',
            'special_occasion' => 'nullable|array',
            'table_location' => 'nullable|string',
            'additional_requests' => 'nullable|string',
        ]);

        // Update the customization entry
        $customization = Customization::findOrFail($id);
        $customization->customizations = json_encode($validated['customizations'] ?? []);
        $customization->special_occasion = json_encode($validated['special_occasion'] ?? []);
        $customization->table_location = $validated['table_location'] ?? null;
        $customization->additional_requests = $validated['additional_requests'] ?? null;
        $customization->save();

        return redirect()->route('customer.reservations.customizations.index')
            ->with('success', 'Customizations updated successfully.');
    }

    public function destroy($id)
    {
        $customization = Customization::findOrFail($id);
        $customization->delete();

        return redirect()->route('customer.reservations.customizations.index')
            ->with('success', 'Customization deleted successfully.');
    }

    public function restaurantCustomizations()
    {
        $customizations = Customization::whereNotNull('customizations')->get(); // Adjust query as needed
        return view('restaurant.customizations', compact('customizations'));
    }

}
