<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    const STATUS_PENDING = 0;
    const STATUS_PAID = 1;
    const STATUS_CANCELED = 2;
    const STATUS_COMPLETED = 3;

    protected $fillable = [
        'bookingDate',
        'totalPrice',
        'status',
        'contactName',
        'contactPhone',
        'contactEmail',
        'field_id',
        'time_id',
        'customer_id',
        'employee_id',
    ];

    public function Fields()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function TimeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_id');
    }

    public function Bills()
    {
        return $this->hasMany(Bill::class, 'booking_id');
    }

    public function PaymentMethod()
    {
        return $this->hasOneThrough(
            PaymentMethod::class,
            Bill::class,
            'booking_id',
            'id',
            'id',
            'payment_id'
        );
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public static function updateCompletedBookings()
    {
        $bookings = self::with('TimeSlot')
            ->where('status', self::STATUS_PAID)
            ->get();

        foreach ($bookings as $booking) {
            if (!$booking->TimeSlot) {
                continue;
            }

            $endTime = Carbon::parse($booking->bookingDate . ' ' . $booking->TimeSlot->endTime);

            if (now()->greaterThan($endTime)) {
                $booking->update([
                    'status' => self::STATUS_COMPLETED,
                ]);
            }
        }
    }
}
