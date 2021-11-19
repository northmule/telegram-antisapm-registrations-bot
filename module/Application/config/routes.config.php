<?php

use Laminas\Router\Http\Literal;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Application\Controller\General::class,
                        'action'     => 'home',
                    ],
                ],
            ],
        ],
    ],
];
