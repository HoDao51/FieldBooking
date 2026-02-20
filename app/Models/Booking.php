<?php

namespace App\Models;

use App\Http\Controllers\FieldController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'bookingDate',
        'totalPrice',
        'status',
        'field_id',
        'time_id',
        'payment_id',
        'customer_id',
    ];
    public function Fields(){
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function TimeSlot(){
        return $this->belongsTo(TimeSlot::class, 'time_id');
    }

    public function PaymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
