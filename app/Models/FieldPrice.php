<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldPrice extends Model
{
    /** @use HasFactory<\Database\Factories\FieldPriceFactory> */
    use HasFactory;

    protected $fillable = [
        'price',
        'day_of_week',
        'field_id',
        'time_id',
    ];

    public function Field(){
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function TimeSlot(){
        return $this->belongsTo(TimeSlot::class, 'time_id');
    }
}
