<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EnrollmentType extends Pivot
{
    use Sluggable;

    public $incrementing = true;
    public $timestamps = true;
    protected $table = 'enrollment_types';

    protected $fillable = ['description'];

    protected $primaryKey = 'slug';

    public function getSlugAttribute()
    {
        return $this->attributes['slug'] ?? null;
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
          'slug' => [
              'source' => 'description',
              'separator' => ''
          ]
        ];
    }
}
