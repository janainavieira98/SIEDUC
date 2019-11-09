<?php


namespace App\Repositories;


use App\Classroom;
use Illuminate\Support\Facades\DB;

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

    public function create($data)
    {
        return DB::transaction(function() use ($data) {
            $collection = collect($data);
            $model = parent::create($collection->only([
                'grade',
                'description',
                'period_slug',
                'start_hour',
                'end_hour',
                'year',
                'start_date',
                'end_date',
                'max_users'
            ])->toArray());

            $model->weekdays()->sync($data['weekdays'] ?: []);

            return $model;
        });
    }

    public function update(Classroom $model, $data)
    {
        return DB::transaction(function() use ($model, $data) {
            $collection = collect($data);
            $model->update($collection->only([
                'grade',
                'description',
                'period_slug',
                'start_hour',
                'end_hour',
                'year',
                'start_date',
                'end_date',
                'max_users'
            ])->toArray());

            $model->weekdays()->sync($data['weekdays'] ?: []);

            return $model->fresh();
        });
    }
}
