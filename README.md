[![Stable? Not Quite Yet](https://img.shields.io/badge/stable%3F-not%20quite%20yet-blue?style=for-the-badge)](https://packagist.org/packages/enlivenapp/hello-world-plugin)
[![License](https://img.shields.io/packagist/l/enlivenapp/hello-world-plugin?style=for-the-badge)](https://packagist.org/packages/enlivenapp/hello-world-plugin)
[![PHP Version](https://img.shields.io/packagist/php-v/enlivenapp/hello-world-plugin?style=for-the-badge)](https://packagist.org/packages/enlivenapp/hello-world-plugin)
[![Monthly Downloads](https://img.shields.io/packagist/dm/enlivenapp/hello-world-plugin?style=for-the-badge)](https://packagist.org/packages/enlivenapp/hello-world-plugin)
[![Total Downloads](https://img.shields.io/packagist/dt/enlivenapp/hello-world-plugin?style=for-the-badge)](https://packagist.org/packages/enlivenapp/hello-world-plugin)
[![GitHub Issues](https://img.shields.io/github/issues/enlivenapp/FlightPHP-Hello-World-Plugin?style=for-the-badge)](https://github.com/enlivenapp/FlightPHP-Hello-World-Plugin/issues)
[![Contributors](https://img.shields.io/github/contributors/enlivenapp/FlightPHP-Hello-World-Plugin?style=for-the-badge)](https://github.com/enlivenapp/FlightPHP-Hello-World-Plugin/graphs/contributors)
[![Latest Release](https://img.shields.io/github/v/release/enlivenapp/FlightPHP-Hello-World-Plugin?style=for-the-badge)](https://github.com/enlivenapp/FlightPHP-Hello-World-Plugin/releases)
[![Contributions Welcome](https://img.shields.io/badge/contributions-welcome-blue?style=for-the-badge)](https://github.com/enlivenapp/FlightPHP-Hello-World-Plugin/pulls)

# Hello World Plugin

A reference plugin for FlightPHP apps using the [FlightSchool](https://github.com/enlivenapp/FlightPHP-Flight-School) plugin loader. Use it as a starting point when building your own plugin.

## What it demonstrates

- Returning config values with auto-prefixed keys (Config/Config.php)
- Defining routes that get auto-prefixed by the PluginLoader (Config/Routes.php)
- Three different ways to get a config value into a controller method
- Providing views that the host app can override
- Creating runway commands

## Config and route prefixes

The PluginLoader auto-prefixes config keys and routes based on the package name so plugins don't step on each other. This plugin's defaults are:

| | Default | With override uncommented |
|---|---|---|
| **Config key** | `enlivenapp.hello-world-plugin` | `hello-world` |
| **Route prefix** | `/enlivenapp_hello_world_plugin` | `/hello-world` |

To use the shorter versions, set `configPrepend` and `routePrepend` inside the returned array in `src/Config/Config.php`.

## Plugin structure

```
src/
  Plugin.php                  <- Optional. Called after Config/ files are loaded.
  commands/
    HelloWorldCommand.php   <- Runway CLI command (must be lowercase, see below).
  Config/
    Config.php              <- Config values and optional prepend overrides. Loaded first.
    Services.php            <- Documentation only. Services use Composer autoloading.
    Routes.php              <- Routes. Auto-wrapped in a prefix group by the PluginLoader.
  Controllers/
    HelloController.php     <- Handles requests. Three methods, three patterns.
  Views/
    index.php               <- Default view for the /hello route.
    app-override-index.php  <- Copy this to override the view (see below).
```

**Note:** `commands/` must be lowercase. Runway discovers command files by scanning the filesystem directly, not through Composer's autoloader. All other directories follow PSR-4 convention (uppercase).

## Installation

```bash
composer require enlivenapp/hello-world-plugin
```

## Configuration

When Composer installs the plugin, FlightSchool adds an entry to `app/config/config.php`:

```php
'enlivenapp/hello-world-plugin' => [
    'enabled' => false,
    'priority' => 50,
],
```

To activate the plugin, change `'enabled'` to `true`.

Config values live in `src/Config/Config.php`. The PluginLoader stores the returned array on `$app` under the config prepend key. To change a value, edit that file directly.

## Flight School config

This package uses Flight School's return-array config format. `src/Config/Config.php` returns the package defaults as an array, Flight School stores that array under `enlivenapp.hello-world-plugin` on `$app`, and prepend overrides belong inside that returned array instead of as standalone variables.

The current example uses:

```php
return [
    // 'configPrepend' => 'hello-world',
    'routePrepend' => 'hello-world',
    'greeting' => 'Hello from a vendor plugin!',
];
```

## Reading config

`$app` is available in Config/ files, route files, and controllers (passed to the constructor). Read the full config array, then index into it:

```php
$config = $app->get('enlivenapp.hello-world-plugin');
$greeting = $config['greeting'];
```

Models and services don't receive `$app` automatically — pass the values they need as parameters.

## Routes

The PluginLoader wraps all routes in a prefix group automatically. With the default prefix:

| Route | Response | How it gets the greeting |
|---|---|---|
| GET `/enlivenapp_hello_world_plugin` | HTML view | Passed as a method parameter from Routes.php |
| GET `/enlivenapp_hello_world_plugin/hola` | JSON | Reads `$this->config` (set in the constructor) |
| GET `/enlivenapp_hello_world_plugin/hello` | HTML view | Passed as a method parameter from Routes.php |
| GET `/enlivenapp_hello_world_plugin/hallo` | JSON | Reads config from `$app->get()` in the method |

With `'routePrepend' => 'hello-world'` set in the returned config array, routes become `/hello-world`, `/hello-world/hola`, etc.

## Overriding views

The plugin includes a ready-to-use override template. Copy it to your app's views directory:

```bash
cp vendor/enlivenapp/hello-world-plugin/src/Views/app-override-index.php \
   app/views/enlivenapp/hello-world-plugin/index.php
```

You may need to create the directory first:

```bash
mkdir -p app/views/enlivenapp/hello-world-plugin
```

Once the override is in place, the plugin will use your version instead of its own.

## License

MIT
