<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    public $observers = [
        User::class => [
            UserObserver::class
        ]
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->observers as $model => $observer) {
            if (is_array($observer)) {
                foreach ($observer as $observerItem) {
                    $this->observe($model, $observerItem);
                }
            } else {
                $this->observe($model, $observer);
            }
        }
    }

    protected function observe($model, $observer)
    {
        resolve($model)->observe($observer);
    }
}
