<?php
return [
    'telegramBot' => [
        'apiKey' => getenv('APP_MODULE_TELEGRAM_BOT_TOKEN'), //  Токен можно узнать/создать через @BotFather
        'botUsername' =>  getenv('APP_MODULE_TELEGRAM_BOT_USERNAME'),
        'bootHookUrl' => getenv('APP_MODULE_TELEGRAM_BOT_HOOK_URL'), //Внешний адрес куда должны поступать запросы от Телеграм
        'logger' => [
            'telegramLog' => __DIR__.'/../../data/logs/telegram.log', // Путь до файла логов запросов Телеграм
            'fileLog' => __DIR__.'/../../data/logs/globalLogs.log', // Путь до файла логов ошибок
        ],
        'disableRouteSet' => getenv('APP_MODULE_TELEGRAM_DISABLE_SET'), // Отключить режим настройки
    ]
];