<?php

declare(strict_types=1);

namespace Telegram\Commands;


use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Application;
use Laminas\ServiceManager\ServiceManager;

/**
 * Внедряем зависимости основного приложения
 * Trait AppTrait
 *
 * @package Telegram\Commands
 */
trait AppTrait
{
    public function getApplication(): Application
    {
        if (!file_exists(__DIR__ . '/../../../../../config/application.config.php')){
            throw new \Exception('Не доступен файл конфигурации приложения application.config.php');
        }
        $appConfig = require __DIR__ . '/../../../../../config/application.config.php';
        $app =  Application::init($appConfig);
        return $app;
    }
    
    public function getServiceManager(): ServiceManager
    {
        $app = $this->getApplication();
        $serviceManager = $app->getServiceManager();
        return $serviceManager;
    }
    public function getEntityManager(): EntityManager
    {
        return $this->getServiceManager()->get('doctrine.entitymanager.orm_default');
    }
}