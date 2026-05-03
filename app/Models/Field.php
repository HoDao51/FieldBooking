<?php

namespace App\Models;

use Carbon\Carbon;
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
        'facility_id',
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

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function getFirstImageAttribute()
    {
        return $this->images->first();
    }

    public function getPricesByDate($date)
    {
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeekIso;

        return $this->FieldPrice
            ->where('day_of_week', $dayOfWeek)
            ->sortBy(function ($price) {
                return $price->TimeSlot->startTime;
            });
    }

    public function splitTimeSlots($prices)
    {
        return [
            'morning' => $prices->filter(function ($price) {
                return \Carbon\Carbon::parse($price->TimeSlot->startTime)->hour < 12;
            }),

            'afternoon' => $prices->filter(function ($price) {
                $hour = \Carbon\Carbon::parse($price->TimeSlot->startTime)->hour;
                return $hour >= 12 && $hour < 18;
            }),

            'evening' => $prices->filter(function ($price) {
                return \Carbon\Carbon::parse($price->TimeSlot->startTime)->hour >= 18;
            }),
        ];
    }

    public function getBookedSlots($date)
    {
        $fieldIds = [$this->id];

        if ($this->FieldType) {
            if ($this->FieldType->name == 'Sân 11 người') {
                $fieldIds = Field::where('facility_id', $this->facility_id)
                    ->pluck('id')
                    ->all();
            }

            if ($this->FieldType->name == 'Sân 5 người') {
                $fieldIds = Field::where('facility_id', $this->facility_id)
                    ->whereHas('FieldType', function ($query) {
                        $query->where('name', 'Sân 11 người');
                    })
                    ->pluck('id')
                    ->all();

                $fieldIds[] = $this->id;
            }
        }

        return Booking::whereDate('bookingDate', $date)
            ->whereIn('field_id', $fieldIds)
            ->where('status', '!=', 2)
            ->pluck('time_id')
            ->all();
    }

    public function getPastSlots($date)
    {
        $selectedDate = Carbon::parse($date)->toDateString();

        if ($selectedDate != now()->toDateString()) {
            return [];
        }

        return TimeSlot::where('startTime', '<=', now())
            ->pluck('id')->all();
    }
}