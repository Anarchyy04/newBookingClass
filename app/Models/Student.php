<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Student extends Model implements AuthenticatableContract
{
    use Notifiable, Authenticatable;

    protected $fillable = ['username', 'nim', 'password'];

    public function bookings()
{
    return $this->hasMany(Booking::class, 'student_id');
}


    
}
