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

To use the shorter versions, uncomment `$configPrepend` and `$routePrepend` in `src/Config/Config.php`.

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

## Reading config

`$app` is available in Config/ files, Routes.php, and controllers (passed to the constructor). Read the full config array, then index into it:

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

With `$routePrepend = 'hello-world'` uncommented, routes become `/hello-world`, `/hello-world/hola`, etc.

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
