<?php
namespace Telegram;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\Mvc\MvcEvent;
use Telegram\Events\Events;
use Telegram\Map\Events as EventsMap;

/**
 * Модуль бота Телеграм
 * Class Module
 *
 * @package Telegram
 */
class Module implements ConfigProviderInterface
{
    
    public function onBootstrap(MvcEvent $e)
    {
        /** @var \Telegram\Events\Events $eventsService */
        $eventsService = $e->getApplication()->getServiceManager()->get(Events::class);
        $e->getApplication()->getEventManager()->attach(EventsMap::NEW_USER_CREATED_AN_ANSWER_VERIFICATION_QUESTION,[$eventsService,'checkUsersResponse']);
        $e->getApplication()->getEventManager()->attach(EventsMap::NEW_USER_SENT_REQUEST_TO_JOIN_GROUP,[$eventsService,'processRequestToJoinGroup']);

    }
    
    public function getConfig()
    {
        $config = array_merge(
            [],
            require __DIR__.'/config/module.config.php',
            require __DIR__.'/config/routes.config.php',
            require __DIR__.'/config/telegrambot.config.php',
            require __DIR__.'/config/view.config.php',
            require __DIR__.'/config/doctrine.config.php'
        );
        
        return $config;
    }
    
}