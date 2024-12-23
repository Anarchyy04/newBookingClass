<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = ['room', 'capacity', 'day', 'start_time', 'end_time'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'class_id'); // Gunakan 'class_id'
    }
    
    
}
