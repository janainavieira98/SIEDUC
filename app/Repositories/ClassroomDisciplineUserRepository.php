<?php


namespace App\Repositories;


use App\ClassroomDisciplineUser;

class ClassroomDisciplineUserRepository extends BaseRepository
{
    public static $model = ClassroomDisciplineUser::class;

    public function searchable(): array
    {
        return [
            $this->generateRelationSearchQuery('classroom', [
                'grade',
                'description',
                'start_hour',
                'end_hour',
                'year',
                'start_date',
                'end_date',
                'max_users',
            ]),
            $this->generateRelationSearchQuery('discipline', [
                'code',
                'name'
            ]),
            $this->generateRelationSearchQuery('user', [
                'name',
                'email',
                'cpf',
                'rg'
            ])
        ];
    }

    public function create($data)
    {
        $collection = collect($data);
        return parent::create($collection->only(['classroom_id', 'user_id', 'discipline_id', 'hour', 'weekday_slug'])->toArray());
    }
}
