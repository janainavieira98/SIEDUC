<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomDisciplineUser extends Pivot
{
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $table = 'classroom_discipline_user';

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
}
