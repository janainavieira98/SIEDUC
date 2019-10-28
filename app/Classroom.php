<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'grade',
        'description',
        'period_slug',
        'start_hour',
        'end_hour',
        'year',
        'start_date',
        'end_date',
        'max_users'
    ];

    public function weekdays()
    {
        return $this->belongsToMany(Weekday::class);
    }
}
