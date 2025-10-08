<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'people_count',
        'orders',
        'total_amount',
        'status'
    ];

    protected $casts = [
        'orders' => 'array',
        'total_amount' => 'decimal:2'
    ];

    public function getFormattedTotalAttribute()
    {
        return 'IDR ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getWhatsAppLinkAttribute()
    {
        $phone = '6281332428118'; // Nomor WhatsApp owner

        $message = "Halo Temani Ngemil! Saya ingin melakukan reservasi:\n\n";
        $message .= "📋 *Detail Reservasi*\n";
        $message .= "Nama: " . $this->name . "\n";
        $message .= "Nomor HP: " . $this->phone . "\n";
        $message .= "Alamat: " . $this->address . "\n";
        $message .= "Jumlah Orang: " . $this->people_count . " orang\n";
        $message .= "Total Pembayaran: " . $this->formatted_total . "\n\n";

        $message .= "🍽️ *Pesanan:*\n";
        foreach ($this->orders as $order) {
            $message .= "- " . $order['name'] . " (x" . $order['quantity'] . ") = IDR " . number_format($order['subtotal'], 0, ',', '.') . "\n";
        }

        $message .= "\nTerima kasih!";

        return "https://wa.me/" . $phone . "?text=" . urlencode($message);
    }
}
