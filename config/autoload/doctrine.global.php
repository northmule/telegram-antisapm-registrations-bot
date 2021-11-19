<?php

return [
    'doctrine'        => [
        'connection'               => [
            'orm_default' => [
                'driverClass'   => Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                'eventmanager'  => 'orm_default',
                'configuration' => 'orm_default',
                'params'        => [
                    'driver'        => 'pdo_mysql',
                    'user'          => getenv('APP_DB_MAIN_USER'),
                    'password'      => getenv('APP_DB_MAIN_PASSWORD'),
                    'dbname'        => getenv('APP_DB_DBNAME'),
                    'host'          => getenv('APP_DB_HOST'),
                    'charset'       => getenv('APP_DB_CHARSET'),
                    'port'          => getenv('APP_DB_PORT'),
                    'driverOptions' => [
                        1002 => 'SET NAMES ' . getenv('APP_DB_CHARSET'),
                    ],
                ],
            ],
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'table_storage'           => [
                    'table_name'                 => 'doctrine_migration_versions',
                    'version_column_name'        => 'version',
                    'version_column_length'      => 1024,
                    'executed_at_column_name'    => 'executed_at',
                    'execution_time_column_name' => 'execution_time',
                ],
                'migrations_paths'        => [
                    'Telegram\Migrations' => __DIR__ . '/../../data/Migrations',
                ],
                'all_or_nothing'          => true,
                'check_database_platform' => true,
            ],
        ],
        'configuration'            => [
            'orm_default' => [
                'metadata_cache'   => 'array',
                'query_cache'      => 'array',
                'result_cache'     => 'array',
                'hydration_cache'  => 'array',
                'generate_proxies' => true,
                'proxy_dir'        => 'data/doctrine/DoctrineORMModule/Proxy',
                'proxy_namespace'  => 'DoctrineORMModule\Proxy',
                'filters'          => [],
            ],
        ],
        'entitymanager'            => [
            'orm_default' => [
                'connection'    => 'orm_default',
                'configuration' => 'orm_default',
            ],
        ],
        'eventmanager'             => [
            'orm_default' => [
                'subscribers' => [],
            ],
        ],
        'entity_resolver'          => [
            'orm_default' => [
                'resolvers' => [],
            ],
        ],

    ],
    'service_manager' => [
        'aliases'   => [],
        'factories' => [
            'doctrine.connection.orm_wp'    => new DoctrineORMModule\Service\DBALConnectionFactory('orm_default'),
            'doctrine.entitymanager.orm_wp' => new DoctrineORMModule\Service\EntityManagerFactory('orm_default'),
        ],
    ],

];
