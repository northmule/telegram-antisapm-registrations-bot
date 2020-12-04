<?php
return [
    'view_manager' => [
        'template_map' => [
            'layout/layout'         => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'            => __DIR__ . '/../view/telegram/index/index.phtml',
            'application/index/json'             => __DIR__ .'/../view/telegram/index/json.phtml',
            'error/index'            =>  __DIR__ .'/../view/error/index.phtml',
            'error/404'              => __DIR__ .'/../view/error/404.phtml',
            'telegram/main/index' =>  __DIR__ .'/../view/telegram/main/index.phtml',
        ],
        'template_path_stack' => [
            Telegram\Module::class => __DIR__ .'/../view',
        ],
    
    ],
];


