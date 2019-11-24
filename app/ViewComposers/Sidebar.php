<?php


namespace App\ViewComposers;


use App\Classroom;
use App\ClassroomDisciplineUser;
use App\Discipline;
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
                        'link' => route('alunos.index'),
                        'show' => $this->can('viewAny', User::class)
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
                    ],
                    [
                        'name' => __('link disciplines'),
                        'link' => route('vincular-disciplinas.index'),
                        'show' => $this->can('viewAny', ClassroomDisciplineUser::class)
                    ]
                ]
            ],
            [
                'name' => __('manage system'),
                'items' => [
                    [
                        'name' => __('register class'),
                        'link' => route('classes.index'),
                        'show' => $this->can('viewAny', Classroom::class)
                    ],
                    [
                        'name' => __('register discipline'),
                        'link' => route('disciplinas.index'),
                        'show' => $this->can('viewAny', Discipline::class)
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
