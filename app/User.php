<?php

namespace App;

use App\Foundation\BaseUser;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'birthday',
        'rg',
        'cpf',
        'address_id',
        'phone_id',
        'gender_id',
        'role_id',
        'status'
    ];

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Carbon::parse($value);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
      'birthday' => 'date'
    ];

    protected $with = ['role'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    public function getRoleSlugAttribute()
    {
        return $this->role->slug;
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function scopeStudent($query)
    {
        return $query->whereHas('role', function($q) {
           $q->where('slug', '=', Role::$STUDENT);
        });
    }

    public function scopeInstitutionMember($query)
    {
        return $query->whereHas('role', function($q) {
            $q->where('slug', '!=', Role::$STUDENT);
        });
    }

    public function scopeTeachers($query)
    {
        return $query->whereHas('role', function($q) {
            $q->where('slug', '=', Role::$TEACHER);
        });
    }

    public function teachClassrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_discipline_user')->using(ClassroomDisciplineUser::class);
    }

    public function teachDisciplines()
    {
        return $this->belongsToMany(Discipline::class, 'classroom_discipline_user')->using(ClassroomDisciplineUser::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

}
