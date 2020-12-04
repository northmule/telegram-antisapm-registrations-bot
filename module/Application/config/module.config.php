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

            ],
        'invokables' => [
            Application\Controller\General::class => Application\Controller\General::class,
        ],
    ],

];