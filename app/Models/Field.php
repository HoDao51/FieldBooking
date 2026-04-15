<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    /** @use HasFactory<\Database\Factories\FieldFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'status',
        'type_id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function FieldPrice()
    {
        return $this->hasMany(FieldPrice::class);
    }

    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function FieldType()
    {
        return $this->belongsTo(FieldType::class, 'type_id');
    }

    public function getClusterFieldIds(): array
    {
        return self::query()
            ->withoutTrashed()
            ->where('address', $this->address)
            ->pluck('id')
            ->toArray();
    }

    public function getPricesByDate($date)
    {
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeekIso;

        return $this->FieldPrice
            ->where('day_of_week', $dayOfWeek)
            ->sortBy(fn($p) => $p->TimeSlot->startTime);
    }

    public function splitTimeSlots($prices)
    {
        return [
            'morning' => $prices->filter(
                fn($p) =>
                \Carbon\Carbon::parse($p->TimeSlot->startTime)->hour < 12
            ),

            'afternoon' => $prices->filter(function ($p) {
                $hour = \Carbon\Carbon::parse($p->TimeSlot->startTime)->hour;
                return $hour >= 12 && $hour < 18;
            }),

            'evening' => $prices->filter(
                fn($p) =>
                \Carbon\Carbon::parse($p->TimeSlot->startTime)->hour >= 18
            ),
        ];
    }

    public function getBookedSlots($date)
    {
        // Khởi tạo danh sách id sân - bắt đầu bằng chính sân này
        $fieldIds = [];
        $fieldIds[] = $this->id;

        $fieldType = $this->FieldType;

        if ($fieldType) {
            if ($fieldType->name == 'Sân 11 người') {
                // Nếu là sân 11, lấy tất cả sân cùng địa chỉ
                $allFields = Field::where('address', $this->address)->get();
                $fieldIds = [];
                foreach ($allFields as $field) {
                    $fieldIds[] = $field->id;
                }
            } elseif ($fieldType->name == 'Sân 5 người') {
                // Nếu là sân 5, thêm các sân 11 cùng địa chỉ
                $sân11Fields = Field::where('address', $this->address)
                    ->with('FieldType')
                    ->get();

                foreach ($sân11Fields as $field) {
                    if ($field->FieldType && $field->FieldType->name == 'Sân 11 người') {
                        $fieldIds[] = $field->id;
                    }
                }
            }
        }

        // Danh sách khung giờ bị khóa
        $blockedTimeIds = [];

        $bookings = \App\Models\Booking::whereDate('bookingDate', $date)->get();

        foreach ($bookings as $booking) {
            if (in_array($booking->field_id, $fieldIds)) {
                if ($booking->status != 2) {
                    $blockedTimeIds[] = $booking->time_id;
                }
            }
        }

        return $blockedTimeIds;
    }

    public function getBlockedSlots($date)
    {
        // Khung giờ đã được đặt
        $bookedSlots = $this->getBookedSlots($date);

        // Khung giờ bị khóa (status = 0)
        $lockedSlots = [];
        $timeSlots = TimeSlot::where('status', 0)->get();
        foreach ($timeSlots as $slot) {
            $lockedSlots[] = $slot->id;
        }

        // Gộp danh sách
        $allBlockedSlots = [];
        foreach ($bookedSlots as $timeId) {
            $allBlockedSlots[] = $timeId;
        }
        foreach ($lockedSlots as $timeId) {
            $allBlockedSlots[] = $timeId;
        }

        // Xóa phần tử trùng
        $blockedSlots = [];
        foreach ($allBlockedSlots as $timeId) {
            if (in_array($timeId, $blockedSlots) == false) {
                $blockedSlots[] = $timeId;
            }
        }

        return $blockedSlots;
    }
}