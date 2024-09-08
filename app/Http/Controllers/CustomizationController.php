<?php

namespace App\Http\Controllers;

use App\Models\Customization; // Import the Customization model
use App\Models\Reservation; // Import the Reservation model
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index($reservationId)
    {
        // Fetch customizations for the specific reservation ID
        $customizations = Customization::where('reservation_id', $reservationId)->get();

        return view('customer.customizations.index', compact('customizations', 'reservationId'));
    }

    public function create($reservation_id)
    {
        // Fetch reservations (or filter based on your logic)
        $reservations = Reservation::all(); // Adjust this as needed

        // Pass the reservations and reservation_id to the view
        return view('customer.customizations.create', [
            'reservations' => $reservations,
            'reservationId' => $reservation_id
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id|unique:customizations,reservation_id',
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
            'table_location' => $validated['table_location'] ?? null,
            'additional_requests' => $validated['additional_requests'],
        ]);

        return redirect()->route('customer.reservations.customizations.index', ['reservation_id' => $validated['reservation_id']])
            ->with('success', 'Customization created successfully.');
    }

    public function edit($reservation_id, $id)
    {
        $customization = Customization::where('reservation_id', $reservation_id)->where('id', $id)->firstOrFail();
        return view('customer.customizations.edit', compact('customization', 'reservation_id'));
    }


    public function update(Request $request, $reservation_id, $id)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'customizations' => 'array',
            'special_occasion' => 'array',
            'table_location' => 'nullable|string',
            'additional_requests' => 'nullable|string',
        ]);

        $customization = Customization::where('reservation_id', $reservation_id)->where('id', $id)->firstOrFail();
        $customization->customizations = json_encode($validated['customizations'] ?? []);
        $customization->special_occasion = json_encode($validated['special_occasion'] ?? []);
        $customization->table_location = $validated['table_location'] ?? null;
        $customization->additional_requests = $validated['additional_requests'];
        $customization->save();

        return redirect()->route('customer.reservations.customizations.index', ['reservation_id' => $reservation_id])
            ->with('success', 'Customization updated successfully.');
    }


    public function destroy($reservation_id, $id)
    {
        $customization = Customization::where('reservation_id', $reservation_id)->where('id', $id)->firstOrFail();
        $customization->delete();
        return redirect()->route('customer.reservations.customizations.index', ['reservation_id' => $reservation_id])
            ->with('success', 'Customization deleted successfully.');
    }


    public function show($reservationId)
    {
        // Fetch the customizations based on the reservation ID
        $customizations = Customization::where('reservation_id', $reservationId)->get();

        // Check if customizations exist, and pass the data to the view
        return view('restaurant.customizations', [
            'customizations' => $customizations,
            'reservationId' => $reservationId,
        ]);
    }

}
