<?php

declare(strict_types=1);

namespace Coderun\Telegram\Commands;


use Coderun\Telegram\Service\TelegramApi;
use Laminas\EventManager\EventManager;
use Laminas\ModuleManager\Listener\ServiceListenerInterface;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use Coderun\Telegram\Map\Events;



class CallbackqueryCommand extends SystemCommand
{

    /**
     * @var string
     */
    protected $name = 'callbackquery';
    
    /**
     * @var string
     */
    protected $description = 'Сообщение с кнопки приветсвия';
    
    /**
     * @var string
     */
    protected $version = '1.0.0';
    
    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        /** @var TelegramApi $this->telegram */
        /** @var \Laminas\EventManager\EventManager $eventManager */
        $eventManager = $this->telegram->getServiceManager()->get(EventManager::class);
        /** @var \Longman\TelegramBot\Entities\CallbackQuery $callback */
        $callback = $this->getCallbackQuery();
        /** @var \Longman\TelegramBot\Entities\Message $message */
        $message = $callback->getMessage();
        /** @var \Longman\TelegramBot\Entities\User $user */
        $user = $callback->getFrom();


        $eventManager->trigger(
            Events::NEW_USER_CREATED_AN_ANSWER_VERIFICATION_QUESTION,
            null,
            ['message' => $message,'user' => $user,'callback' => $callback]
        );
        
        return Request::emptyResponse();
        
    }
}