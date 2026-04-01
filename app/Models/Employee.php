<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phoneNumber',
        'email',
        'role',
        'status',
        'user_id',
    ];

    public function Booking()
    {
        return $this->hasMany(Booking::class, 'employee_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
