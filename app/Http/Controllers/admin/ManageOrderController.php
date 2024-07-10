<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->get();
        return view('pages.admin.manage-orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('pages.admin.manage-orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update([
            'status' => $request->status,
            'last_update' => now(),
        ]);

        return redirect()->route('admin.manage-orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.manage-orders.index')->with('success', 'Order deleted successfully.');
    }
}
