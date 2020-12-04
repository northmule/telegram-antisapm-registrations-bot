<?php
declare(strict_types=1);

use Laminas\Mvc\Application;
use Laminas\Stdlib\ArrayUtils;

chdir(__DIR__);

// ddd
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (is_string($path) && __FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

require 'vendor/autoload.php';

if (! class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run laminas composer install` if you are using Docker.\n"
    );
}

$appMode = 'application';//

if ($appMode === 'application') {
    $appConfig = require __DIR__ . '/config/application.config.php';
    if (file_exists(__DIR__ . '/config/development.config.php')) {
        $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/config/development.config.php');
    }
    $app =  Application::init($appConfig);
    $app->run();

    
    
    
} else {
    $application = Laminas\Mvc\Application::init(require __DIR__ . '/config/application.config.php');
    /** @var \Laminas\Mvc\Application $application */
    
    /** @var \Laminas\ServiceManager\ServiceManager $sm */
    $serviceManager = $application->getServiceManager();
    $serviceManager->get('ModuleManager')->loadModules();
    /** @var \Doctrine\ORM\EntityManager $entityManager */
    $entityManager = $serviceManager->get('doctrine.entitymanager.orm_wp');
}




