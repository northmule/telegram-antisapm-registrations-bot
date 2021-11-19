<?php

return [
    'telegramBot' => [
        'apiKey'          => getenv('APP_MODULE_TELEGRAM_BOT_TOKEN'), //  Токен можно узнать/создать через @BotFather
        'botUsername'     => getenv('APP_MODULE_TELEGRAM_BOT_USERNAME'),
        'bootHookUrl'     => getenv('APP_MODULE_TELEGRAM_BOT_HOOK_URL'), //Внешний адрес куда должны поступать запросы от Телеграм
        'logger'          => [
            'telegramLog' => __DIR__ . '/../../data/logs/telegram.log', // Путь до файла логов запросов Телеграм
            'fileLog'     => __DIR__ . '/../../data/logs/globalLogs.log', // Путь до файла логов ошибок
        ],
        'disableRouteSet' => getenv('APP_MODULE_TELEGRAM_DISABLE_SET'), // Отключить режим настройки
        'showGreetingAfterResponse' => getenv('APP_SHOW_GREETING_AFTER_RESPONSE') === 'yes', // Показывать приветствие после вступления в группу
        'textOfGreeting' => getenv('APP_TEXT_OF_GREETING'), // Текст приветствия после успешного ответа
        'textQuestion' => getenv('APP_TEXT_QUESTION'), // Текст вопроса, можно указать #user_name# - будет заменён на имя вступившего
        'askQuestions' => getenv('APP_ASK_QUESTIONS') === 'yes', // Задавать вопросов? Если false, проверки вопросом не будет
    ],
];
