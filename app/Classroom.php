<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use Sluggable;

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

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function weekdays()
    {
        return $this->belongsToMany(Weekday::class);
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
              'source' => ['description', 'grade'],
              'separator' => ''
          ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'classroom_discipline_user')->using(ClassroomDisciplineUser::class);
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'classroom_discipline_user')->using(ClassroomDisciplineUser::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
