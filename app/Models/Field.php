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

    public function conflicts()
    {
        return $this->belongsToMany(Field::class, 'field_conflicts', 'field_id', 'conflict_field_id');
    }

    public function reverseConflicts()
    {
        return $this->belongsToMany(Field::class, 'field_conflicts', 'conflict_field_id', 'field_id');
    }

    public function getConflictFieldIds()
    {
        $ids = [];

        $ids[] = $this->id;

        foreach ($this->conflicts as $item) {
            $ids[] = $item->id;
        }

        foreach ($this->reverseConflicts as $item) {
            $ids[] = $item->id;
        }

        return array_values(array_unique($ids));
    }

    public function getLinkedFieldsAttribute()
    {
        return $this->conflicts
            ->merge($this->reverseConflicts)
            ->unique('id')
            ->values();
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
        $conflictFieldIds = $this->getConflictFieldIds();

        return \App\Models\Booking::whereIn('field_id', $conflictFieldIds)
            ->where('bookingDate', $date)
            ->whereNotIn('status', [2])
            ->pluck('time_id')
            ->toArray();
    }
}
