<?php

/**
 * Controller for the Hello World plugin.
 * 
 * This is geared for beginners, experts will find the descriptions
 * beyond obvious.
 *
 * All request handling lives here, Config/Routes.php sets up the routes 
 * this class does the work.
 *
 * Each method shows a different way to get a config value into a method:
 *
 *  - hola()  uses $this->config, a class property set in __construct()
 *  - hello() receives $greeting as a method parameter (passed from Routes.php)
 *  - hallo() reads the value directly from $app using the config prepend key
 *
 * @package   Enlivenapp\HelloWorldPlugin\Controllers
 * @copyright 2026 enlivenapp
 * @license   MIT
 */

declare(strict_types=1);

namespace Enlivenapp\HelloWorldPlugin\Controllers;

use flight\Engine;

/**
 * Handles requests for the Hello World plugin's routes.
 *
 * The constructor receives the FlightPHP app, which gives every
 * method access to things like responses and view rendering.
 * Plugin config is also read in the constructor and saved to
 * $this->config so any method can use it.
 */
class HelloController
{
    /** @var Engine The FlightPHP app instance. */
    protected Engine $app;

    /** @var array Plugin config, stored here so any method can use it. */
    protected array $config;

    /**
     * Set up the controller with the app and plugin config.
     *
     * For routes that use [Class, 'method'] syntax (like /hola and
     * /hallo), Flight creates the controller and passes in the app
     * automatically. For routes that use a function (like / and /hello),
     * Config/Routes.php creates the controller with `new HelloController($app)`.
     *
     * Either way, we grab the plugin config here and save it to
     * $this->config so it's available to any method that needs it.
     *
     * @param Engine $app The FlightPHP app instance.
     */
    public function __construct(Engine $app)
    {
        $this->app = $app;
        // Fall back to a default if the config wasn't set by Config.php.
        // We added the fallback to make sure the plugin doesn't fail,
        // this usually isn't required.
        $this->config = $app->get('enlivenapp.hello-world-plugin') ?? ['greeting' => 'Hello World!'];
    }

    /**
     * GET /hello-world/hola returns JSON.
     *
     * Gets the greeting from $this->config, which was set in __construct().
     * This is useful when multiple methods need the same values. Read
     * them once and reuse them.
     */
    public function hola(): void
    {
        $this->app->json([
            'message' => $this->config['greeting'],
            'plugin'  => 'enlivenapp/hello-world-plugin',
            'source'  => 'vendor',
            'status'  => 'loaded',
        ]);
    }

    /**
     * GET /hello-world and /hello-world/hello renders an HTML view.
     *
     * The greeting is passed in from Config/Routes.php when the route
     * calls this method. See the route for / and /hello in that file.
     *
     * The view can be overridden by the host app. A ready-to-use
     * override template is included with the plugin at:
     *   vendor/enlivenapp/hello-world-plugin/src/Views/app-override-index.php
     * Copy it to:
     *   app/views/enlivenapp/hello-world-plugin/index.php
     *
     * @param string $greeting The greeting to display.
     */
    public function hello(string $greeting): void
    {
        $this->app->render('enlivenapp/hello-world-plugin/index', [
            'greeting' => $greeting,
        ]);
    }

    /**
     * GET /hello-world/hallo returns JSON (German greeting).
     *
     * Gets the greeting by reading it from the app with
     * $this->app->get(). This is a simple way to grab a value
     * when you only need it in one method.
     */
    public function hallo(): void
    {
        $config = $this->app->get('enlivenapp.hello-world-plugin');

        $this->app->json([
            'message' => $config['greeting'],
            'lang'    => 'de',
            'plugin'  => 'enlivenapp/hello-world-plugin',
        ]);
    }
}
