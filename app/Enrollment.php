<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['user_id', 'classroom_id', 'date', 'enrollment_type_slug', 'roll_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function enrollmentType()
    {
        return $this->belongsTo(EnrollmentType::class);
    }
}
