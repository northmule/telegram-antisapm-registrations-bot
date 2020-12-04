<?php
namespace Application;


use Laminas\ModuleManager\Feature\ConfigProviderInterface;



class Module implements ConfigProviderInterface
{
    
    
    public function getConfig()
    {
        $config = array_merge(
            [],
            require __DIR__.'/config/view.config.php',
            require __DIR__.'/config/routes.config.php',
            require __DIR__.'/config/module.config.php',

        );
    
        return $config;
    }
    
}