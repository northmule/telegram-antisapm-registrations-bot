<?php
use Laminas\Router\Http\Literal;


return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options'       => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Coderun\Telegram\Controller\Bot::class,
                        'action'     => 'home',
                    ],
                ],
            ],
            // слушает команды сервиса Telegram
            'botEcho' => [
                'type' => Literal::class,
                'options'       => [
                    'route' => '/bot-echo',
                    'defaults' => [
                        'controller' => Coderun\Telegram\Controller\Bot::class,
                        'action'     => 'echo',
                    ],
                ],
            ],
            // Установка обработчика. Выполняется 1-н раз для настройки
            'setHook' => [
                'type' => Literal::class,
                'options'       => [
                    'route' => '/set-hook',
                    'defaults' => [
                        'controller' => Coderun\Telegram\Controller\Service::class,
                        'action'     => 'setHook',
                    ],
                ],
            ],
        ],
    ],



];