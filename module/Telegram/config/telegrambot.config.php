<?php

/**
 * Команды
 * @see https://github.com/php-telegram-bot/example-bot/tree/master/Commands
 *
 */

return [
    'telegramBot' => [
        'apiKey' => getenv('APP_MODULE_TELEGRAM_BOT_TOKEN'), //  Токен можно узнать/создать через @BotFather
        'botUsername' => getenv('APP_MODULE_TELEGRAM_BOT_USERNAME'),
        'bootHookUrl' => getenv('APP_MODULE_TELEGRAM_BOT_HOOK_URL'), //Внешний адрес куда должны поступать запросы от Телеграм
        'commandsPath' => [__DIR__.'/../src/Telegram/Commands'], // Папки к командам
    ]
];