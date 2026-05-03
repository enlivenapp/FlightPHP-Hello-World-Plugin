<?php

/**
 * Config for the Hello World plugin.
 *
 * configPrepend — the key your config is stored under on $app.
 *   Default: 'enlivenapp.hello-world-plugin' (vendor/package)
 *
 * routePrepend — the URL prefix for all your routes.
 *   Default: 'enlivenapp_hello_world_plugin' (vendor/package)
 *
 * Set either key in the returned config array to override the default.
 * Leave them unset to use the defaults.
 *
 * Return your config values as an array. They get stored on $app
 * so you can read them anywhere in your plugin:
 *
 * @var \flight\Engine $app
 */

return [
    // Uncomment to store config under 'hello-world' instead of
    // 'enlivenapp.hello-world-plugin':
    // 'configPrepend' => 'hello-world',

    // Routes at /hello-world/* instead of /enlivenapp_hello_world_plugin/*
    'routePrepend' => 'hello-world',
    'greeting'     => 'Hello from a vendor plugin!',
];
