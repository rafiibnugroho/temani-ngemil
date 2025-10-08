<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'people_count' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong! Silakan tambahkan menu terlebih dahulu.'
            ]);
        }

        $total = array_sum(array_column($cart, 'subtotal'));

        $reservation = Reservation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'people_count' => $request->people_count,
            'orders' => array_values($cart), // Convert ke array biasa
            'total_amount' => $total,
            'status' => 'pending'
        ]);

        // Clear cart setelah reservasi berhasil
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dibuat!',
            'whatsapp_link' => $reservation->whats_app_link,
            'reservation_id' => $reservation->id
        ]);
    }

    public function show(Reservation $reservation)
    {
        return view('reservation', compact('reservation'));
    }
}
