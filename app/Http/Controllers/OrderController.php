<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        return view('pages.customer.order.create', compact('menu'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form order
        $validatedData = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil objek Menu berdasarkan menu_id
        $menu = Menu::findOrFail($validatedData['menu_id']);

        // Buat order baru
        $order = Order::create([
            'customer_id' => Auth::id(),
            'order_date' => now(),
            'total_amount' => $validatedData['quantity'] * $menu->price,
        ]);

        // Simpan detail order
        OrderDetail::create([
            'order_id' => $order->id,
            'menu_id' => $validatedData['menu_id'],
            'quantity' => $validatedData['quantity'],
            'subtotal' => $menu->price * $validatedData['quantity'],
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('order.payment', $order->id)->with('success', 'Order berhasil dibuat.');
    }

    public function payment($orderId)
    {
        $order = Order::findOrFail($orderId);
        $paymentMethods = PaymentMethod::all();
        return view('pages.order.payment', compact('order', 'paymentMethods'));
    }

    public function processPayment(Request $request, $orderId)
    {
        // Validasi data pembayaran
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            // Tambahan validasi sesuai metode pembayaran yang Anda dukung
        ]);

        // Ambil order berdasarkan $orderId
        $order = Order::findOrFail($orderId);

        // Simpan data pembayaran ke dalam model Payment
        Payment::create([
            'order_id' => $order->id,
            'payment_date' => now(),
            'amount' => $validatedData['amount'],
            'payment_method_id' => 1, // Ganti dengan ID metode pembayaran yang sesuai
            // Tambahkan fields lain sesuai kebutuhan
        ]);

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Pembayaran berhasil.');
    }
}
