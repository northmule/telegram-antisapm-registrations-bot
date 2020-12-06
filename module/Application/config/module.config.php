<?php


return [
    'service_manager' =>[
        'factories' => [],
        'invokables' => [],
        'aliases' => []
    ],
    'controllers' => [
        'factories' =>
            [
                Application\Events\Events::class => Application\Events\Factory\Events::class
            ],
        'invokables' => [
            Application\Controller\General::class => Application\Controller\General::class,
        ],
    ],

];