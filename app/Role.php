<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $SECRETARY = 'secretary';
    public static $DIRECTOR = 'director';
    public static $TEACHER = 'teacher';

    protected $fillable = ['name', 'slug'];

    public function scopeSecretary($query)
    {
        return $query->where('slug', 'secretary');
    }
}
