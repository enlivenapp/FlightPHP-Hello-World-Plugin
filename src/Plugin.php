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

class Plugin implements PluginInterface
{
    /**
     * Called by the PluginLoader after all Config/ files are loaded.
     *
     * Use this for custom setup that doesn't belong in Config/ files
     * (events, middleware, etc.). This plugin has nothing extra to do.
     *
     * @param Engine $app    The FlightPHP app instance.
     * @param Router $router The FlightPHP router.
     * @param array  $config The config array returned by Config/Config.php.
     * @return void
     */
    public function register(Engine $app, Router $router, array $config = []): void
    {
    }
}
