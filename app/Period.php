<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $primaryKey = 'slug';

    protected $fillable = [
        'slug'
    ];

    protected function getSlugAttribute()
    {
        return $this->attributes['slug'];
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
