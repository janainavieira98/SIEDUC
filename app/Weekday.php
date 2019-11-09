<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{
    protected $appends = ['description'];

    protected $primaryKey = 'slug';

    public function getDescriptionAttribute()
    {
        return __($this->attributes['slug']);
    }

    public function getSlugAttribute()
    {
        return $this->attributes['slug'];
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
