<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = ['name', 'slug'];

    public function scopeMale($query)
    {
        return $query->where('slug', 'male');
    }

    public function scopeFemale($query)
    {
        return $query->where('slug', 'female');
    }
}
