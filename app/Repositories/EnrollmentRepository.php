<?php


namespace App\Repositories;


use App\Enrollment;

class EnrollmentRepository extends BaseRepository
{
    public static $model = Enrollment::class;

    public function searchable(): array
    {
        return [
            'date',
            $this->generateRelationSearchQuery('user', [
                'name',
                'email',
                'cpf',
                'rg'
            ]),
            $this->generateRelationSearchQuery('classroom', [
                'description'
            ]),
        ];
    }

    public function deleteModel(Enrollment $enrollment)
    {
        $enrollment->delete();
    }
}
