<?php

declare(strict_types=1);

namespace Blumilk\Version;

class VersionHelper
{
    public static function generateShortVersion(
        string $pathToVersionScript = Version::PATH_TO_VERSION_SCRIPT,
        string $pathToCheckScript = Version::PATH_TO_CHECK_SCRIPT,
    ): string {
        return (new Version($pathToVersionScript, $pathToCheckScript))->generate();
    }

    public static function generateLongVersion(
        string $pathToVersionScript = Version::PATH_TO_VERSION_SCRIPT,
        string $pathToCheckScript = Version::PATH_TO_CHECK_SCRIPT,
    ): string {
        return (new Version($pathToVersionScript, $pathToCheckScript, long: true))->generate();
    }
}
