<?php

namespace App;

use App\Enhancements\HasDisciplinesThroughClassrooms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasDisciplinesThroughClassrooms;

    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function totalGrade($part)
    {
        $total = 0;

        for ($i = 1; $i <= $part; $i++) {
            $total += $this->attributes["grade$i"] ?: 0;
        }

        return $total;
    }

    public function averageGrade($part)
    {
        $total = $this->totalGrade($part);

        return $total / $part;
    }

    public function totalAbsences($part)
    {
        $absences = 0;

        for ($i = 1; $i <= $part; $i++) {
            $absences += $this->attributes["absences$i"] ?: 0;
        }

        return $absences;
    }
}
