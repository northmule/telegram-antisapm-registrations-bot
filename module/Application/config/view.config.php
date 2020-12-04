<?php
return [
    'view_manager' => [
        'template_map' => [
            'layout/layout'         => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'            => __DIR__ . '/../view/application/index/index.phtml',
            'telegram/index/json'             => __DIR__ .'/../view/application/index/json.phtml',
            'error/index'            =>  __DIR__ .'/../view/error/index.phtml',
            'error/404'              => __DIR__ .'/../view/error/404.phtml',
            'application/main/index' =>  __DIR__ .'/../view/application/main/index.phtml',
        ],
        'template_path_stack' => [
            Application\Module::class => __DIR__ .'/../view',
        ],
    
    ],
];


