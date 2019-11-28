<?php


namespace App\Enhancements;


use App\Classroom;
use App\Discipline;
use Illuminate\Database\Eloquent\Builder;

trait HasDisciplinesThroughClassrooms
{
    public function scopeFromDisciplineAndClassroom(Builder $query, Discipline $discipline, Classroom $classroom)
    {
        return $query->whereHas('classroom', function ($classroomQuery) use ($discipline, $classroom) {
            $classroomQuery->where('classrooms.id', $classroom->id)
                ->whereHas('disciplines', function ($disciplineQuery) use ($discipline) {
                    $disciplineQuery->where('disciplines.id', $discipline->id);
                });
        });
    }
}
