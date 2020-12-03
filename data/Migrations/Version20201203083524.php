<?php

declare(strict_types=1);

namespace Telegram\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203083524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coderun_bot_telegram_users_chat (id INT AUTO_INCREMENT NOT NULL, userId BIGINT DEFAULT NULL COMMENT \'ИД пользователя Телеграм\', userName VARCHAR(250) DEFAULT NULL COMMENT \'логин пользователя\', approved TINYINT(1) NOT NULL COMMENT \'Можно писать в чат или нет\', languageCode VARCHAR(20) DEFAULT NULL COMMENT \'Код языка\', chatId BIGINT NOT NULL COMMENT \'ИД чата\', chatName VARCHAR(250) DEFAULT NULL COMMENT \'Имя чата\', dateCreated DATETIME DEFAULT NULL COMMENT \'Дата создания записи\', dateUpdated DATETIME DEFAULT NULL COMMENT \'Дата обновления записи\', uuid VARCHAR(36) DEFAULT NULL COMMENT \'Уникальный код, автогенерируется при вставке\', dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2F8DF3B6D17F50A6 (uuid), INDEX user_in_chat_idx (userId, chatId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'Пользователи чата\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coderun_bot_telegram_users_chat');
    }
}
