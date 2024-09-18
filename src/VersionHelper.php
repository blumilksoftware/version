<?php

declare(strict_types=1);

namespace Blumilk\Version;

class VersionHelper
{
    public static function generateShortVersion(
        string $pathToVersionScript = Version::PATH_TO_VERSION_SCRIPT,
        string $pathToCheckScript = Version::PATH_TO_CHECK_SCRIPT,
    ): string {
        return (new Version(
            pathToVersionScript: $pathToVersionScript,
            pathToCheckScript: $pathToCheckScript,
        ))->generate();
    }

    public static function generateLongVersion(
        string $pathToVersionScript = Version::PATH_TO_VERSION_SCRIPT,
        string $pathToCheckScript = Version::PATH_TO_CHECK_SCRIPT,
    ): string {
        return (new Version(
            long: true,
            pathToVersionScript: $pathToVersionScript,
            pathToCheckScript: $pathToCheckScript,
        ))->generate();
    }
}
