<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    /** @use HasFactory<\Database\Factories\TimeSlotFactory> */
    use HasFactory;

    protected $fillable = [
        'startTime',
        'endTime',
    ];

    public function Booking(){
        return $this->hasMany(Booking::class);
    }

    public function FieldPrice(){
        return $this->hasMany(FieldPrice::class);
    }
}
