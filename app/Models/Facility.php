<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    /** @use HasFactory<\Database\Factories\FacilityFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
