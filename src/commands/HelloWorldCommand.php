<?php

/**
 * @copyright 2026 enlivenapp
 * @license   MIT
 */

declare(strict_types=1);

namespace Enlivenapp\HelloWorldPlugin\Commands;

use flight\commands\AbstractBaseCommand;

class HelloWorldCommand extends AbstractBaseCommand
{
    public function __construct(array $config)
    {
        parent::__construct('hello-world', 'Say hello from the Hello World plugin', $config);
    }

    public function execute(): void
    {
        $this->app()->io()->write('Hello World', true);
    }
}
