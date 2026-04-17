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

class HelloController
{
    protected Engine $app;
    protected array $config;

    /**
     * @param Engine $app The FlightPHP app instance.
     */
    public function __construct(Engine $app)
    {
        $this->app = $app;
        $this->config = $app->get('enlivenapp.hello-world-plugin');
    }

    /**
     * Return the greeting as JSON using config cached in the constructor.
     *
     * Shows how to read config once in __construct() and reuse it
     * across multiple methods via $this->config.
     *
     * @return void
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
     * Render the greeting as an HTML view.
     *
     * Shows how Routes.php can read a config value and pass it
     * into a controller method as a parameter.
     *
     * @param string $greeting The greeting text to display.
     * @return void
     */
    public function hello(string $greeting): void
    {
        $this->app->render('enlivenapp/hello-world-plugin/index', [
            'greeting' => $greeting,
        ]);
    }

    /**
     * Return the greeting as JSON by reading config on demand.
     *
     * Shows how to read config directly from $app->get() in the
     * method itself, without caching it in the constructor.
     *
     * @return void
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
