<?php

/**
 * Config for the Hello World plugin.
 *
 * The PluginLoader includes this file and stores the returned array
 * on $app under the $configPrepend key. Access it anywhere with:
 *
 *   $app->get('hello-world')           // whole array
 *   $app->get('hello-world.greeting')  // single value (if Flight supports dot access)
 *
 * Collision avoidance:
 *   Set $configPrepend and $routePrepend to override the defaults.
 *   If not set, the PluginLoader derives them from the package name:
 *     - Config default: enlivenapp.hello-world-plugin
 *     - Route default:  enlivenapp_hello_world_plugin
 *
 * @var \flight\Engine $app
 */

// Optional: override the auto-generated collision avoidance prefixes.
// Remove these lines to use the defaults derived from the package name.
//$configPrepend = 'hello-world';
$routePrepend = 'hello-world';

return [
    'greeting' => 'Hello from a vendor plugin!',
];
