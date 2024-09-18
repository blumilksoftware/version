<?php

declare(strict_types=1);

use Blumilk\Version\VersionHelper;
use PHPUnit\Framework\TestCase;

class VersionHelperTest extends TestCase
{
    public function testGeneratingVersionBasedOnGit(): void
    {
        $version = VersionHelper::generateShortVersion(
            pathToVersionScript: "./version.sh",
            pathToCheckScript: "./check.sh",
        );

        $this->assertIsString($version);
        $this->assertStringNotContainsString("|", $version);
    }

    public function testGeneratingLongVersionBasedOnGit(): void
    {
        $version = VersionHelper::generateLongVersion(
            pathToVersionScript: "./version.sh",
            pathToCheckScript: "./check.sh",
        );
        $versionHash = trim(shell_exec("git log --format='%h' -n 1"));

        $this->assertIsString($version);
        $this->assertStringContainsString("|", $version);
        $this->assertStringContainsString($versionHash, $version);
    }
}
