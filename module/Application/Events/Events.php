<?php

declare(strict_types=1);

namespace Application\Events;

use Doctrine\ORM\EntityManager;
use Laminas\EventManager\Event;
use Laminas\Log\Logger;
use Laminas\ServiceManager\ServiceManager;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Entities\User as UserEntities;
use Application\Entity\UsersChat;
use Northmule\Telegram\Map\Events as EventsMap;

class Events
{
    /**
     * @var ServiceManager
     */
    protected ServiceManager $serviceManager;
    /**
     * @var EntityManager
     */
    protected EntityManager $entityManager;
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Events constructor.
     *
     * @param EntityManager  $entityManager
     * @param ServiceManager $serviceManager
     * @param Logger         $logger
     */
    public function __construct(
        EntityManager $entityManager,
        ServiceManager $serviceManager,
        Logger $logger
    ) {
        $this->serviceManager = $serviceManager;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * Вызывается для добавления пользователя в таблицу
     * @param Event $event
     */
    public function addUserToTable(Event $event): void
    {
        $message = $event->getParam('message', null);
        $members = $event->getParam('members', []);

        if (!($message instanceof Message)) {
            return;
        }
        /** @var UserEntities $user */
        $user = reset($members);
        if (!($user instanceof UserEntities)) {
            return;
        }

        try {
            $userChat = new UsersChat();
            $userChat->setApproved(false);
            $userChat->setChatId($message->getChat()->getId());
            $userChat->setChatName($message->getChat()->getUsername() ?? '');
            $userChat->setLanguageCode($user->getLanguageCode() ?? '');
            $userChat->setUserId($user->getId());
            $userChat->setUserName($user->getUsername() ?? '');
            $this->entityManager->persist($userChat);
            $this->entityManager->flush();
        } catch (\Throwable $e) {
            $this->logger->err($e->getMessage(), $e->getTrace());
            return;
        }
    }

    public function updateUserToTable(Event $event): void
    {
        $message = $event->getParam('message', null);
        $user = $event->getParam('user', null);

        if (!($message instanceof Message)) {
            $this->logger->info(sprintf('Процесс обработки события %s, ожидается объект %s', EventsMap::THE_NEW_USER_ANSWERED_CORRECTLY, Message::class));
            return;
        }

        if (!($user instanceof UserEntities)) {
            $this->logger->info(sprintf('Процесс обработки события %s, ожидается объект %s', EventsMap::THE_NEW_USER_ANSWERED_CORRECTLY, UserEntities::class));

            return;
        }
        try {
            $repository = $this->entityManager->getRepository(UsersChat::class);
            $userChat = $repository->findOneBy(['userId' => $user->getId(), 'chatId' => $message->getChat()->getId()], ['id' => 'DESC']);
            if (!($userChat instanceof UsersChat)) {
                return;
            }
            $userChat->setApproved(true);
            $this->entityManager->persist($userChat);
            $this->entityManager->flush();
        } catch (\Throwable $e) {
            $this->logger->err($e->getMessage(), $e->getTrace());
            return;
        }
    }
}
