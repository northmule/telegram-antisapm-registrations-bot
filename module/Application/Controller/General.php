<?php

declare(strict_types=1);

namespace Application\Controller;


use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;



class General extends AbstractActionController
{
    
    
    /**
     * Application constructor.
     *
     */
    public function __construct()
    {
    }
    
    public function homeAction()
    {
        return $this->indexAction();
    }
    
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('application/main/index');
        return $view;
    }

}