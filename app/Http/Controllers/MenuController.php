<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua menu yang tersedia
        $allMenus = Menu::all();


        // Ambil 8 menu pertama
        $initialMenus = $allMenus->take(8);

        // Ambil menu sisanya
        $remainingMenus = $allMenus->skip(8);

        return view('welcome', compact('initialMenus', 'remainingMenus'));
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        // Simulasi penambahan ke session cart
        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity'] += $request->quantity;
            $cart[$request->menu_id]['subtotal'] = $cart[$request->menu_id]['quantity'] * $menu->price;
        } else {
            $cart[$request->menu_id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => $request->quantity,
                'subtotal' => $menu->price * $request->quantity,
                'image' => $menu->image
            ];
        }

        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));

        // --- Perbaikan dimulai di sini ---
        // Hitung ulang total dari semua item di keranjang
        $total = array_sum(array_column($cart, 'subtotal'));

        return response()->json([
            'success' => true,
            'message' => $menu->name . ' berhasil ditambahkan ke keranjang!',
            'cart_count' => $cartCount,
            'cart' => $cart,
            // Tambahkan total harga ke respons
            'total' => $total,
            'formatted_total' => 'IDR ' . number_format($total, 0, ',', '.')
        ]);
        // --- Perbaikan berakhir di sini ---
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $total = array_sum(array_column($cart, 'subtotal'));

        return response()->json([
            'cart' => $cart,
            'cart_count' => $cartCount,
            'total' => $total,
            'formatted_total' => 'IDR ' . number_format($total, 0, ',', '.')
        ]);
    }

    public function updateCartItem(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity'] = $request->quantity;
            $cart[$request->menu_id]['subtotal'] = $cart[$request->menu_id]['quantity'] * $cart[$request->menu_id]['price'];

            session()->put('cart', $cart);

            $cartCount = array_sum(array_column($cart, 'quantity'));
            $total = array_sum(array_column($cart, 'subtotal'));

            return response()->json([
                'success' => true,
                'cart_count' => $cartCount,
                'total' => $total,
                'formatted_total' => 'IDR ' . number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan']);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            unset($cart[$request->menu_id]);
            session()->put('cart', $cart);

            $cartCount = array_sum(array_column($cart, 'quantity'));
            $total = array_sum(array_column($cart, 'subtotal'));

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang',
                'cart_count' => $cartCount,
                'total' => $total,
                'formatted_total' => 'IDR ' . number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan']);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan',
            'cart_count' => 0,
            'total' => 0
        ]);
    }
}
