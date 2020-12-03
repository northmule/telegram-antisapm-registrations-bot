<?php

declare(strict_types=1);

namespace Telegram\Events;

use Doctrine\ORM\EntityManager;
use Laminas\EventManager\Event;
use Laminas\ServiceManager\ServiceManager;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Request;
use Telegram\Map\QuestionKeyboard;
use Telegram\Service\KeybordQuestion;
use Telegram\Service\TelegramRestrict;


class Events
{
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var EntityManager
     */
    protected $entityManager;
    
    /**
     * Events constructor.
     *
     * @param ServiceManager $serviceManager
     * @param EntityManager  $entityManager
     */
    public function __construct(
        EntityManager $entityManager,
        ServiceManager $serviceManager
    ) {
        $this->serviceManager = $serviceManager;
        $this->entityManager = $entityManager;
    }
    
    
    /**
     * Проверка ответа пользователя на вопрос от Бота
     */
    public function checkUsersResponse(Event $event)
    {
        $message = $event->getParam('message',null);
        $user = $event->getParam('user',null);
        $callback = $event->getParam('callback', null);
        
        if (!($message instanceof Message)) {
            return;
        }
        
        if (!($user instanceof User)) {
            return;
        }
        if (!($callback instanceof CallbackQuery)) {
            return;
        }
        
        $approved = false;
        
        if ($callback->getData() === QuestionKeyboard::CALLBACK_ANSWER_HUMAN.$user->getId()) {
            $approved = true;
        }
        
        /** @var  TelegramRestrict $restrictionService */
        $restrictionService = $this->serviceManager->get(TelegramRestrict::class);
        
        if ($approved) {
            // Снимаем ограничения
            $restrictionService->unsetRestrict($message->getChat()->getId(),$user->getId());
            
            // Удаление сообщения
            Request::deleteMessage(
                [
                    'chat_id' => $message->getChat()->getId(),
                    'message_id' => $message->getMessageId(),
                ]
            );
            
            // Отправляем сообщение
            return  Request::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text'    => "Добро пожаловать!",
                'disable_notification' => true,
            ]);
            
        }
        
    }
    
    /**
     * Обработка действия пользователя на вступление в группу
     * @param Event $event
     */
    public function processRequestToJoinGroup(Event $event)
    {
        $message = $event->getParam('message',null);
        $members = $event->getParam('members',[]);
        if (!($message instanceof Message)) {
            return;
        }
        
        /** @var KeybordQuestion $keybord */
        $keybord = $this->serviceManager->get(KeybordQuestion::class);
        $keybord->setCurentUserId((string)$message->getFrom()->getId());
        /** @var  TelegramRestrict $restrictionService */
        $restrictionService = $this->serviceManager->get(TelegramRestrict::class);
        $question = $keybord->getQuestion();
        // Ограничить нового пользователя в правах, до ответа на вопрос
        $restrictionService->setRestrict($message->getChat()->getId(),$message->getFrom()->getId());
        
        if ($message->botAddedInChat()) { // только бот
            return  Request::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text'    => "Привет бот!",
                'disable_notification' => true,
            ]);
        }
        
        $member_names = [];
        /** @var \Longman\TelegramBot\Entities\User $member */
        foreach ($members as $member) {
            $member_names[] = $member->tryMention();
        }
 
        return  Request::sendMessage(
            array_merge([
                'chat_id' => $message->getChat()->getId(),
                'text'    => 'Привет! ' . implode(', ', $member_names) . '! Скажи, кто ты?',
                'disable_notification' => true,
            ],$question)
        );
        
    }
}