<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;

// Homepage
Route::get('/', [MenuController::class, 'index'])->name('home');

// Menu routes
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [MenuController::class, 'getCart'])->name('cart.get');
Route::put('/cart/update', [MenuController::class, 'updateCartItem'])->name('cart.update');
Route::delete('/cart/remove', [MenuController::class, 'removeFromCart'])->name('cart.remove');
Route::delete('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');

// Reservation routes
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/{reservation}', [ReservationController::class, 'show'])->name('reservation.show');
