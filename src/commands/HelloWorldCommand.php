<?php

/**
 * Runway CLI command for the Hello World plugin.
 *
 * Run with: php runway hello-world
 *
 * @package   Enlivenapp\HelloWorldPlugin\Commands
 * @copyright 2026 enlivenapp
 * @license   MIT
 */

declare(strict_types=1);

namespace Enlivenapp\HelloWorldPlugin\Commands;

use flight\commands\AbstractBaseCommand;

class HelloWorldCommand extends AbstractBaseCommand
{
    /**
     * Register the command name and description.
     *
     * @param array $config Runway config passed by the CLI runner.
     */
    public function __construct(array $config)
    {
        parent::__construct('hello-world', 'Say hello from the Hello World plugin', $config);
    }

    /**
     * Print a greeting to the console.
     *
     * @return void
     */
    public function execute(): void
    {
        $this->app()->io()->write('Hello World', true);
    }
}
