<?php


namespace App\Repositories;


use App\Classroom;

class ClassroomRepository extends BaseRepository
{
    public static $model = Classroom::class;

    public function searchable(): array
    {
        return [
            'grade',
            'description',
            'start_hour',
            'end_hour',
            'year',
            'start_date',
            'end_date',
            'max_users'
        ];
    }
}
