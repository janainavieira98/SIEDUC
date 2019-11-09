<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $appends = ['description'];

    protected $primaryKey = 'slug';

    protected $fillable = [
        'slug'
    ];

    public function getDescriptionAttribute()
    {
        return __($this->attributes['slug']);
    }

    protected function getSlugAttribute()
    {
        return $this->attributes['slug'];
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
