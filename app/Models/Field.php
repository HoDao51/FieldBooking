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
}
