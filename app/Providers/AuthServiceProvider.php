<?php

namespace App\Providers;

use App\Discipline;
use App\Policies\DisciplinePolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Auth\InstitutionUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Discipline::class => DisciplinePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->auth->provider('school_member', function($app, array $config) {
           return new InstitutionUserProvider($app['hash'], $config['model']);
        });
    }
}
