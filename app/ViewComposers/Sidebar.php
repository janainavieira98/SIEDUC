<?php


namespace App\ViewComposers;


use Illuminate\View\View;

class Sidebar
{
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
                        'name' => __('register teacher'),
                        'link' => '#'
                    ],
                    [
                        'name' => __('register user'),
                        'link' => route('user.form')
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
