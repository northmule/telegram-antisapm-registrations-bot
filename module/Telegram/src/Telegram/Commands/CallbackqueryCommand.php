<?php

declare(strict_types=1);

namespace Telegram\Commands;


use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use Telegram\Map\Events;



class CallbackqueryCommand extends SystemCommand
{
    use AppTrait;
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
        /** @var \Laminas\EventManager\EventManager $eventManager */
        $eventManager = $this->getApplication()->getEventManager();
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