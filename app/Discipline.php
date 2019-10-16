<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ['code', 'name', 'timeload'];

    public function getRouteKeyName()
    {
        return 'code';
    }
}
