<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    public static $model;

    /**
     * @param array $data
     * @param null $query
     * @return Builder
     */
    public function filteredQuery(array $data = [], $query = null)
    {
        $query = $query ?: $this->getInstance()->query();

        if (isset($data['search'])) {
            $search = $data['search'];
            $searchFields = $data['searchFields'] ?? $this->searchable();

            $query->where(function ($q) use ($search, $searchFields) {
                foreach ($searchFields as $searchField) {
                    if (is_callable($searchField)) {
                        $q->orWhere(function($subQuery) use ($searchField, $search) {
                            $searchField($subQuery, $search);
                        });
                    } else {
                        $q->orWhere($searchField, 'LIKE', "%$search%");
                    }
                }
            });
        }

        return $query;
    }

    public function getInstance()
    {
        return resolve(static::$model);
    }

    abstract public function searchable(): array;

    public function generateRelationSearchQuery($relation, $fields)
    {
        return function($query, $search) use ($relation, $fields) {
            $query->orWhereHas($relation, function($subQuery) use ($fields, $search) {
                $this->filteredQuery([
                    'search' => $search,
                    'searchFields' => $fields,
                ], $subQuery);
            });
        };
    }

    public function create($data)
    {
        return $this->getInstance()->create($data);
    }
}
