<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ['code', 'name', 'timeload'];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'classroom_discipline_user')->using(ClassroomDisciplineUser::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_discipline_user')->using(ClassroomDisciplineUser::class);
    }
}
