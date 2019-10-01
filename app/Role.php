<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $SECRETARY = 'secretary';
    public static $DIRECTOR = 'director';
    public static $TEACHER = 'teacher';
    public static $STUDENT = 'student';

    protected $fillable = ['name', 'slug'];

    public function scopeInstitutionMember($query)
    {
        return $query->where('slug', '!=', static::$STUDENT);
    }

    public function scopeStudent($query)
    {
        return $query->where('slug', static::$STUDENT);
    }

    public function scopeSecretary($query)
    {
        return $query->where('slug', static::$SECRETARY);
    }
}
