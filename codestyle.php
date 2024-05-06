<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$paths = new Paths("src", "tests");

$config = new Config(
    paths: $paths,
);

return $config->config();
