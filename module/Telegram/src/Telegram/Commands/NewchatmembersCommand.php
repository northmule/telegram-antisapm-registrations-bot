<?php

namespace Telegram\Commands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Telegram\Map\Events;
use Longman\TelegramBot\Request;


/**
 * Команда вызывается когда в группу вступает новый участник
 * Class NewchatmembersCommand
 *
 * @package Telegram\Commands
 */
class NewchatmembersCommand extends SystemCommand
{
    use AppTrait;
    /**
     * @var string
     */
    protected $name = 'newchatmembers';
    
    /**
     * @var string
     */
    protected $description = 'New Chat Members';
    
    /**
     * @var string
     */
    protected $version = '1.3.0';
    
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
        /** @var \Laminas\ServiceManager\ServiceManager $serviceManager */
        /** @var \Longman\TelegramBot\Entities\Message $message */
        $message = $this->getMessage();
        /** @var array $members */
        $members = $message->getNewChatMembers();
    
        $eventManager->trigger(
            Events::NEW_USER_SENT_REQUEST_TO_JOIN_GROUP,
            null,
            ['message' => $message,'members' => $members]
        );
    
        return Request::emptyResponse();
    }
    
}