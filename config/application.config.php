<?php

/**
 * If you need an environment-specific system or application configuration,
 * there is an example in the documentation
 * @see https://docs.laminas.dev/tutorials/advanced-config/#environment-specific-system-configuration
 * @see https://docs.laminas.dev/tutorials/advanced-config/#environment-specific-application-configuration
 */

require __DIR__ . '/../init_env.php';

return [
    // Retrieve list of modules used in this application.
    'modules'                 => require __DIR__ . '/modules.config.php',

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => [
        // use composer autoloader instead of laminas-loader
        'use_laminas_loader'       => true,

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths'        => [
            realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php',
        ],

        // Whether or not to enable a configuration cache.
        // If enabled, the merged configuration will be cached and used in
        // subsequent requests.
        'config_cache_enabled'     => false,

        // The key used to create the configuration cache file name.
        'config_cache_key'         => 'application.config.cache',

        // Whether or not to enable a module class map cache.
        // If enabled, creates a module class map cache which will be used
        // by in future requests, to reduce the autoloading process.
        'module_map_cache_enabled' => false,

        // The key used to create the class map cache file name.
        'module_map_cache_key'     => 'application.module.cache',

        // The path in which to cache merged configuration.
        'cache_dir'                => 'data/cache/',
        'module_paths'             => [
            './module',
            './vendor',
        ],

    ],



];
