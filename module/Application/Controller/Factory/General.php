<?php

declare(strict_types=1);

namespace Application\Controller\Factory;

use Application\Controller\General as GeneralController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Northmule\Telegram\Options\ModuleOptions;

class General implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): GeneralController
    {
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);

        return new GeneralController($options);
    }
}
