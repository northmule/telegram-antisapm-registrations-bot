<?php

namespace Application;

use Application\Events\Events;
use Laminas\EventManager\EventManager;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\Mvc\MvcEvent;
use Northmule\Telegram\Map\Events as EventsMap;

class Module implements ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        /** @var Events $eventsService */
        $eventsService = $e->getApplication()->getServiceManager()->get(
            Events::class
        );
        $eventManager = $e->getApplication()->getServiceManager()->get(
            EventManager::class
        );
        $eventManager->attach(
            EventsMap::NEW_USER_SENT_REQUEST_TO_JOIN_GROUP,
            [$eventsService, 'addUserToTable']
        );
        $eventManager->attach(
            EventsMap::THE_NEW_USER_ANSWERED_CORRECTLY,
            [$eventsService, 'updateUserToTable']
        );
    }

    public function getConfig()
    {
        $config = array_merge(
            [],
            require __DIR__ . '/config/view.config.php',
            require __DIR__ . '/config/routes.config.php',
            require __DIR__ . '/config/module.config.php',
            require __DIR__ . '/config/doctrine.config.php',
        );

        return $config;
    }
}
