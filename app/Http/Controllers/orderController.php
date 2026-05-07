<?php

namespace App\Http\Controllers;

use App\Models\Order; // Ensure you have the Order model
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders for the admin.
     */
    public function index()
    {
        // Fetch orders with pagination (best for performance)
        // We order by latest so the newest orders appear at the top
        $orders = Orders::latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specific order details.
     */
    public function show(string $id)
    {
        $order = Orders::findOrFail($id);

        // If you have a relationship with users or order items:
        // $order->load(['user', 'items']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the order status (e.g., from 'pending' to 'completed').
     */
    public function update(Request $request, string $id)
    {
        $order = Orders::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the order from storage.
     */
    public function destroy(string $id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }
}
