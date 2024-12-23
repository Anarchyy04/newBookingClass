<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['student_id', 'teacher_id','class_id', 'is_approved'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id'); 
    }

    public function class()
{
    return $this->belongsTo(ClassModel::class, 'class_id'); 
}


    public function teacher()
{
    return $this->belongsTo(Teacher::class);
}

}
