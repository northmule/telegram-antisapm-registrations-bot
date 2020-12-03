<?php
namespace Telegram\Events\Factory;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Telegram\Events\Events as EventsService;


class Events implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        /** @var \Laminas\Form\FormElementManager\FormElementManagerV3Polyfill $formManager */
        $serviceManager = $container->get('ServiceManager');

        
        return new EventsService($entityManager,$serviceManager);
    }
}