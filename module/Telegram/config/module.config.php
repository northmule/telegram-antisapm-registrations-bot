<?php

use Interop\Container\ContainerInterface;

return [
    'service_manager' =>[
        'factories' => [
            Telegram\Options\ModuleOptions::class => Telegram\Options\Factory\ModuleOptions::class,
            Telegram\Commands\NewchatmembersCommand::class => Telegram\Commands\Factory\NewchatMembers::class,
            Telegram\Events\Events::class => \Telegram\Events\Factory\Events::class,
        ],
        'invokables' => [
            Telegram\Service\KeybordQuestion::class => Telegram\Service\KeybordQuestion::class,
            Telegram\Service\TelegramRestrict::class => Telegram\Service\TelegramRestrict::class,
            \Laminas\EventManager\EventManager::class => \Laminas\EventManager\EventManager::class
           
        ],
        'aliases' => [

        ]
    ],
    'controllers' => [
        'factories' =>
            [
                Telegram\Controller\Bot::class => Telegram\Controller\Factory\Bot::class,
                Telegram\Controller\Service::class =>  Telegram\Controller\Factory\Service::class,
            ],
    ],
    Telegram\Module::class => [
        'disableRouteSet' => getenv('APP_MODULE_TELEGRAM_DISABLE_SET'),
    ],
    'logger' => [
        'telegramLog' => __DIR__.'/../../../data/logs/telegram.log'
    ]
];