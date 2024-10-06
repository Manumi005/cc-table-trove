<?php

namespace App\Http\Controllers;

use App\Models\PreOrder;
use App\Models\Reservation; // Import the Reservation model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreOrderController extends Controller
{
    // Display all pre-orders for a specific reservation
    public function index($reservation_id)
    {
        // Fetch the reservation details
        $reservation = Reservation::findOrFail($reservation_id);

        // Fetch pre-orders related to the specific reservation
        $preorders = PreOrder::where('reservation_id', $reservation_id)
            ->with('menu')
            ->get();

        // Pass both reservation and pre-order data to the view
        return view('customer.preorders.index', compact('preorders', 'reservation'));
    }

    // Show the form for creating a new pre-order
    public function create()
    {
        return view('customer.preorders.create');
    }

    // Store a new pre-order
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            // Check if the same menu item already exists for the given reservation
            $existingPreOrder = PreOrder::where('reservation_id', $request->reservation_id)
                ->where('menu_id', $request->menu_id)
                ->first();

            if ($existingPreOrder) {
                // If it exists, update the quantity instead of creating a new entry
                $existingPreOrder->quantity += $request->quantity;
                $existingPreOrder->save();

                return response()->json(['success' => true, 'message' => 'Item quantity updated in pre-order!']);
            } else {
                // If it doesn't exist, create a new pre-order entry
                PreOrder::create([
                    'reservation_id' => $request->reservation_id,
                    'menu_id' => $request->menu_id,
                    'quantity' => $request->quantity,
                ]);

                return response()->json(['success' => true, 'message' => 'Item added to pre-order!']);
            }
        } catch (\Exception $e) {
            Log::error('Error adding to pre-order:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error adding item to pre-order.']);
        }
    }


    // Submit the pre-order
    public function submitPreOrder(Request $request)
    {
        try {
            $preOrderItems = $request->input('preorder_items');

            // Validate the pre-order items
            $validated = $request->validate([
                'preorder_items' => 'required|array',
                'preorder_items.*.menu_id' => 'required|integer|exists:menus,id',
                'preorder_items.*.quantity' => 'required|integer|min:1',
            ]);

            if (empty($preOrderItems)) {
                return response()->json(['success' => false, 'message' => 'No items in pre-order.']);
            }

            // Save pre-order to the database
            foreach ($preOrderItems as $item) {
                PreOrder::create([
                    'reservation_id' => auth()->user()->currentReservationId(), // Assuming user has a method to get the current reservation
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Store pre-order items in the session to show in the summary
            session(['preOrderItems' => $preOrderItems]);

            return response()->json(['success' => true, 'message' => 'Pre-order submitted successfully!', 'redirect_url' => route('preorder.summary')]);
        } catch (\Exception $e) {
            Log::error('Error submitting pre-order:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error submitting pre-order.']);
        }
    }

    // Display the pre-order summary
    public function summary()
    {
        $preOrderItems = session('preOrderItems', []);
        return view('customer.preorders.summary', compact('preOrderItems'));
    }

    // Adjust the quantity of a pre-order item
    public function adjustQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $preOrder = PreOrder::findOrFail($id);
            $preOrder->update(['quantity' => $request->quantity]);

            return response()->json(['success' => true, 'message' => 'Quantity adjusted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error adjusting quantity:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error adjusting quantity.']);
        }
    }

    // Remove a pre-order item
    public function destroy($id)
    {
        try {
            $preOrder = PreOrder::findOrFail($id);
            $preOrder->delete();

            return response()->json(['success' => true, 'message' => 'Item removed from pre-order!']);
        } catch (\Exception $e) {
            Log::error('Error removing item:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error removing item.']);
        }
    }

    // Display pre-orders for a specific reservation in the restaurant view
    public function restaurantPreordersIndex($reservation_id)
    {
        // Fetch the reservation details
        $reservation = Reservation::findOrFail($reservation_id);

        // Fetch pre-orders related to the specific reservation
        $preorders = PreOrder::where('reservation_id', $reservation_id)
            ->with('menu')
            ->get();

        // Pass both reservation and pre-order data to the new restaurant view
        return view('restaurant.preorders.index', compact('preorders', 'reservation'));
    }

    // Display the payment verification page
    public function payment()
    {
        $preorders = PreOrder::where('reservation_id', auth()->user()->currentReservationId())
            ->with('menu')
            ->get();

        return view('restaurant.payment', [
            'preorders' => $preorders,
            'paymentStatus' => 'Payment Successful',
            'orderStatus' => 'Approved',
            'paymentAmount' => $preorders->sum(fn($preorder) => $preorder->quantity * $preorder->menu->price)
        ]);
    }
    public function orderSummary($restaurantId, $reservationId)
    {
        // Fetch the reservation details
        $reservation = Reservation::findOrFail($reservationId);

        // Fetch pre-orders related to the specific reservation
        $preorders = PreOrder::where('reservation_id', $reservationId)
            ->with('menu')
            ->get();

        // Pass both reservation and pre-order data to the view
        return view('customer.orderSummary', compact('preorders', 'reservation'));
    }


}
