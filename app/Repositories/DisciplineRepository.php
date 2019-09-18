<?php


namespace App\Repositories;


use App\Discipline;

class DisciplineRepository extends BaseRepository
{
    public static $model = Discipline::class;

    public function sortable(): array
    {
        return ['code', 'name'];
    }
}
