<?php


namespace App\Repositories;


use App\Grade;
use Illuminate\Support\Facades\DB;

class GradeRepository extends BaseRepository
{
    public static $model = Grade::class;

    public function searchable(): array
    {
        return [
            $this->generateRelationSearchQuery('classroom', [
                'description',
                'year'
            ]),
            $this->generateRelationSearchQuery('discipline', [
                'code',
                'name'
            ]),
            $this->generateRelationSearchQuery('user', [
                'name',
                'rg',
                'cpf',
                'email'
            ])
        ];
    }

    public function updateModel(Grade $grade, array $data)
    {
        return DB::transaction(function () use ($grade, $data) {
            $collection = collect($data);

//            dd($collection);

            $grade->update($collection->only([
                'grade1',
                'grade2',
                'grade3',
                'grade4',
                'absences1',
                'absences2',
                'absences3',
                'absences4',
                'approved',
            ])->toArray());

            return $grade->fresh();
        });
    }
}
