<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{
    protected $primaryKey = 'slug';

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
