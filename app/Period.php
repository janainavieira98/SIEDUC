<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $primaryKey = 'slug';

    protected $fillable = [
        'slug'
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
