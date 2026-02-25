<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /** @use HasFactory<\Database\Factories\FieldFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'status',
        'type_id',
        'employee_id',
    ];
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function FieldPrice(){
        return $this->hasMany(FieldPrice::class);
    }

    public function Booking(){
        return $this->hasMany(Booking::class);
    }

    public function FieldType(){
        return $this->belongsTo(FieldType::class, 'type_id');
    }

    public function Employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
