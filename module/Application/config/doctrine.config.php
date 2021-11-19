<?php

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine' => [
        'driver' => [
            'telegram_entity_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../Entity'],
            ],
            'orm_default'            => [
                'drivers' => [
                    Application\Entity\UsersChat::class => 'telegram_entity_driver',
                ],

            ],

        ],
    ],
];
