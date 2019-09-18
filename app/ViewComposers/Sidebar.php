<?php


namespace App\ViewComposers;


use App\User;
use Illuminate\View\View;

class Sidebar
{
    public function can(...$args)
    {
        return auth()->user()->can(...$args);
    }

    public function items()
    {
        return [
            [
                'name' => __('school secretary'),
                'items' => [
                    [
                        'name' => __('register student'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('subscribe student'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('scores and presence'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('generate report'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('generate history'),
                        'link' => '#'
                    ]
                ]
            ],
            [
                'name' => __('manage system'),
                'items' => [
                    [
                        'name' => __('register school'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('register discipline'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('register user'),
                        'link' => route('usuarios.index'),
                        'show' => $this->can('viewAny', User::class)
                    ]
                ]
            ],
        ];
    }

    public function compose(View $view)
    {
        $view->with('sidebarCards', $this->items());
    }
}
