<?php

/**
 * Routes for the Hello World plugin.
 *
 * The PluginLoader automatically wraps this file in a
 * $router->group() using the route prepend from Config.php
 * (or the default derived from the package name). You don't
 * need to add your own group wrapper — just define routes
 * as if they're at the root.
 *
 * Available variables:
 *   $router        — the Flight router (passed by the group callback)
 *   $app           — the Flight engine
 *   $configPrepend — the config prefix, for reading plugin config
 */

use Enlivenapp\HelloWorldPlugin\Controllers\HelloController;
use flight\Engine;
use flight\net\Router;

/**
 * @var Router $router
 * @var Engine $app
 * @var string $configPrepend
 */

$greeting = $app->get($configPrepend)['greeting'];

// All routes here are automatically prefixed with the route prepend.
// With the overrides in Config.php commented out, the default derived
// from the package name is used: enlivenapp_hello_world_plugin
//
// These routes become:
//   /enlivenapp_hello_world_plugin/
//   /enlivenapp_hello_world_plugin/hola
//   /enlivenapp_hello_world_plugin/hello
//   /enlivenapp_hello_world_plugin/hallo
//
// If you set 'routePrepend' => 'hello-world' in Config.php:
//   /hello-world/
//   /hello-world/hola
//   /hello-world/hello
//   /hello-world/hallo

$router->get('/', function () use ($app, $greeting) {
    $controller = new HelloController($app);
    $controller->hello($greeting);
});

// hola() reads the greeting from $this->config (set in __construct)
$router->get('/hola', [HelloController::class, 'hola']);

// Same as / above, pass $greeting into the hello() method
$router->get('/hello', function () use ($app, $greeting) {
    $controller = new HelloController($app);
    $controller->hello($greeting);
});

// hallo() reads the greeting from the app directly with $app->get()
$router->get('/hallo', [HelloController::class, 'hallo']);
