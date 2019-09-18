<?php


namespace App\Repositories;


use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    abstract public function sortable(): array;

    public static $model;

    public function getInstance()
    {
        return resolve(static::$model);
    }

    /**
     * @param array $data
     * @return Builder
     */
    public function filteredQuery(array $data = [], $query = null)
    {
        $query = $query ?: $this->getInstance()->query();

        if (isset($data['search'])) {
            $search = $data['search'];
            $fields = $this->sortable();

            $query->where(function ($q) use ($search, $fields) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'LIKE', "%$search%");
                }
            });
        }

        return $query;
    }

    public function create(array $data)
    {
        return $this->getInstance()->create($data);
    }

}
