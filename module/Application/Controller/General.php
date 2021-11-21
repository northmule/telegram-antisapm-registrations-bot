<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Northmule\Telegram\Options\ModuleOptions;

class General extends AbstractActionController
{

    protected $options;

    /**
     * Application constructor.
     *
     */
    public function __construct(ModuleOptions $options)
    {
        $this->options = $options;
    }

    public function homeAction(): ViewModel
    {
        return $this->indexAction();
    }

    public function indexAction(): ViewModel
    {
        $view = new ViewModel(['botUsername' => $this->options->getBotUsername()]);
        $view->setTemplate('application/main/index');
        return $view;
    }
}
