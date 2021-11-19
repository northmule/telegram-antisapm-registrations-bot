<?php

return [
    // Development time modules
    'modules'                 => [],

    'module_listener_options' => [
        'config_cache_enabled'     => (getenv(APP_MODE) === 'prod'),
        'module_map_cache_enabled' => (getenv(APP_MODE) === 'prod'),
    ],
];
