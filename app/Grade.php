<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'classroom_id',
        'discipline_id',
        'grade1',
        'grade2',
        'grade3',
        'grade4',
        'absences1',
        'absences2',
        'absences3',
        'absences4',
        'approved',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}
