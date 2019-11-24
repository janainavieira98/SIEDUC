<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomDisciplineUser extends Pivot
{
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $table = 'classroom_discipline_user';
    public $timestamps = false;

    protected $fillable = ['classroom_id', 'discipline_id', 'user_id', 'hour', 'weekday_slug'];

    public function weekday()
    {
        return $this->belongsTo(Weekday::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
