<?php

/**
 * Hello World Plugin, a reference plugin for FlightPHP apps using
 * the FlightSchool plugin loader.
 *
 * Use this as a starting point when building your own plugin. It shows:
 *
 *  - How to return config with collision-avoidance prefixes (Config/Config.php)
 *  - How to define routes with automatic prefix grouping (Config/Routes.php)
 *  - How to pass a variable into a controller method
 *  - How to provide views that the host app can override
 *
 * Most plugins won't need Plugin.php at all. The PluginLoader handles
 * Config/ files automatically. This file only exists for plugins that
 * need custom setup beyond what Config/ files provide.
 *
 * @package   Enlivenapp\HelloWorldPlugin
 * @copyright 2026 enlivenapp
 * @license   MIT
 */

declare(strict_types=1);

namespace Enlivenapp\HelloWorldPlugin;

use Enlivenapp\FlightSchool\PluginInterface;
use flight\Engine;
use flight\net\Router;

/**
 * Plugin entry point (optional).
 *
 * The PluginLoader calls register() after loading all Config/ files.
 * Use it for anything that doesn't fit in a config, services, or
 * routes file. For this plugin, there's nothing extra to do.
 */
class Plugin implements PluginInterface
{
    public function register(Engine $app, Router $router, array $config = []): void
    {
        // Nothing to do. Config/Config.php and Routes.php handle everything.
        // This method exists as an example. If your plugin needs custom
        // setup (events, middleware, etc.), do it here.
    }
}
