<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    /** @use HasFactory<\Database\Factories\FieldTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'deleted',
    ];

    public function Field(){
        return $this->hasMany(Field::class);
    }
}
