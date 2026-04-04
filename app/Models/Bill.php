<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_id',
        'amount',
        'status',
        'payment_type',
        'paid_at',
        'note',
    ];
    public function Booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function PaymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }
}
