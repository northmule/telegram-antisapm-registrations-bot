<?php

return [
    'service_manager' => [
        'factories'  => [
            Application\Events\Events::class => Application\Events\Factory\Events::class,
        ],
        'invokables' => [],
        'aliases'    => [],
    ],
    'controllers'     => [
        'factories' =>
            [
                Application\Controller\General::class => Application\Controller\Factory\General::class,
            ],

    ],

];
