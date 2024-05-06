<?php

declare(strict_types=1);

namespace Blumilk\Version;

class VersionHelper
{
    public static function generateShortVersion(): string
    {
        return (new Version())->generate();
    }

    public static function generateLongVersion(): string
    {
        return (new Version(long: true))->generate();
    }
}
