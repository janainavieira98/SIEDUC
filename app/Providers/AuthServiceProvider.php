<?php

namespace App\Providers;

use App\Auth\InstitutionUserProvider;
use App\Classroom;
use App\ClassroomDisciplineUser;
use App\Discipline;
use App\Enrollment;
use App\Grade;
use App\Policies\ClassroomDisciplineUserPolicy;
use App\Policies\ClassroomPolicy;
use App\Policies\DisciplinePolicy;
use App\Policies\EnrollmentPolicy;
use App\Policies\GradePolicy;
use App\Policies\UserPolicy;
use App\Role;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Discipline::class => DisciplinePolicy::class,
        Classroom::class => ClassroomPolicy::class,
        ClassroomDisciplineUser::class => ClassroomDisciplineUserPolicy::class,
        Enrollment::class => EnrollmentPolicy::class,
        Grade::class => GradePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->auth->provider('school_member', function ($app, array $config) {
            return new InstitutionUserProvider($app['hash'], $config['model']);
        });

        Gate::define('viewReports', function($user) {
           return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
        });
    }
}
