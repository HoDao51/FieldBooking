<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phoneNumber',
        'email',
        'status',
        'avatar',
        'user_id',
    ];
    public function Booking(){
        return $this->hasMany(Booking::class);
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
