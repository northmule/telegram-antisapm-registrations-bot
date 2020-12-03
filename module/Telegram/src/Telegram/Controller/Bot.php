<?php

declare(strict_types=1);

namespace Telegram\Controller;


use Laminas\Json\Json;
use Laminas\Log\Logger;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Laminas\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Longman\TelegramBot\Telegram;
use Telegram\Options\ModuleOptions;


class Bot extends AbstractActionController
{
    
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var Logger
     */
    protected $logger;
    
    /**
     * @var Telegram
     */
    protected $telegram;
    
    
    /**
     * Categorys constructor.
     *
     * @param EntityManager                $entityManager
     * @param ServiceManager               $serviceManager
     */
    public function __construct(
        EntityManager $entityManager,
        ServiceManager $serviceManager,
        Logger $logger,
        Telegram $telegram
    )
    {
        $this->entityManager = $entityManager;
        $this->serviceManager = $serviceManager;
        $this->logger = $logger;
        $this->telegram = $telegram;
        
    }
public function homeAction()
{
    return $this->indexAction();
}

public function indexAction()
{
    $view = new JsonModel();
    $view->setVariables(['response' =>['success' => true,'result' => null]]);
    $view->setTemplate('application/index/json');
    $headers = $this->getResponse()->getHeaders();
    $this->getResponse()->setHeaders($headers->addHeaders(['Content-Type'=>'application/json','X-Powered-By' => 'Bot']));
    
    return $view;
}

public function echoAction()
{
    
    $options = $this->serviceManager->get(ModuleOptions::class);
    $this->logger->info('Telegram данные: '.$this->getRequest()->getContent());
    $viewResult = '';
    try {
        // Запуск Commands/....
       $this->telegram->handle();
    } catch (Longman\TelegramBot\Exception\TelegramException $e) {
        $this->logger->addWriter(new \Laminas\Log\Writer\Stream($options->getFileLog()));
        $this->logger->err('Возникло исключение: '.$e->getMessage(),[$e->getTrace()]);
        $viewResult =  'error';
    } finally {
        $view = new JsonModel();
        $view->setVariables(['response' =>['success' => true,'result' => $viewResult]]);
        $view->setTemplate('application/index/json');
        $headers = $this->getResponse()->getHeaders();
        $this->getResponse()->setHeaders($headers->addHeaders(['Content-Type'=>'application/json','X-Powered-By' => 'Bot']));
        
        return $view;
    }
    
}
    
    
    
}