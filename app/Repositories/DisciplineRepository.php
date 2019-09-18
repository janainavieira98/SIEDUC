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

    public function update(Discipline $discipline, $data = [])
    {
        $data = collect($data);

        $discipline->update($data->only(['name', 'code'])->toArray());

        return $discipline->fresh();
    }
}
