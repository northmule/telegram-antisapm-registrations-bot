##Скелет приложения Telegram bot для чата - против спам сообщений

Приложение использует элементы Laminas Framework, так же за основу скелета приложения
взята структура Laminas Framework (Бывший Zend Framework)

### Запуск на своём домене
1. Клонируйте репозитарий
2. Настройте ваш сервер так что бы корнем сайта была папка public
3. Переименуйте файл .env.dist в .env
4. Если всё верно - вы увидите страницу приветствия (базовый шаблон приложения)

###Настройка
1. В первую очередь создайте своего бота в Telegram
2. После создания своего бота у вас будет (Токен и имя бота)
3. Заполните все значения в файле .env 
4. Выполните миграцию таблиц Doctrina или выполните запрос на создание нужной таблицы
в вашей MySQL
```
CREATE TABLE `coderun_bot_telegram_users_chat` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`userId` BIGINT(20) NULL DEFAULT NULL COMMENT 'ИД пользователя Телеграм',
	`userName` VARCHAR(250) NULL DEFAULT NULL COMMENT 'логин пользователя' COLLATE 'utf8_unicode_ci',
	`approved` TINYINT(1) NOT NULL COMMENT 'Можно писать в чат или нет',
	`languageCode` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Код языка' COLLATE 'utf8_unicode_ci',
	`chatId` BIGINT(20) NOT NULL COMMENT 'ИД чата',
	`chatName` VARCHAR(250) NULL DEFAULT NULL COMMENT 'Имя чата' COLLATE 'utf8_unicode_ci',
	`dateCreated` DATETIME NULL DEFAULT NULL COMMENT 'Дата создания записи',
	`dateUpdated` DATETIME NULL DEFAULT NULL COMMENT 'Дата обновления записи',
	`uuid` VARCHAR(36) NULL DEFAULT NULL COMMENT 'Уникальный код, автогенерируется при вставке' COLLATE 'utf8_unicode_ci',
	`dtype` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `UNIQ_2F8DF3B6D17F50A6` (`uuid`) USING BTREE,
	INDEX `user_in_chat_idx` (`userId`, `chatId`) USING BTREE
)
COMMENT='Пользователи чата'
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2;
```

5. Выполните запрос в браузере "https://Ваш_домен/set-hook" (APP_MODULE_TELEGRAM_BOT_HOOK_URL - должен содержать https://ваш_домен в .env)
6. Если результат положительный, установите в .env APP_MODULE_TELEGRAM_DISABLE_SET в значение 1
7. Создайте Группу и добавьте туда вашего бота. Сделайте бота администратором группы
8. Протестируйте результат

## Примеры
1. Пример развёрнутого приложения [Здесь](https://bot.zixn.ru)
2. Бот которого можно добавить в свою группу и посмотреть как он работает @akismetBot


## Дополнительная информация
Ссылки на документацию сторонних источников
1. [Laminas](https://getlaminas.org/)
2. [PHP Telegram CORE](https://github.com/php-telegram-bot/core)
3. [TelegramAPI](https://core.telegram.org/)
