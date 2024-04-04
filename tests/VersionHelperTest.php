<?php

declare(strict_types=1);

use Blumilk\Version\VersionHelper;
use PHPUnit\Framework\TestCase;

class VersionHelperTest extends TestCase
{
    public function testGeneratingVersionBasedOnGit(): void
    {
        $version = VersionHelper::generateShortVersion();

        $this->assertIsString($version);
        $this->assertStringNotContainsString("|", $version);
    }

    public function testGeneratingLongVersionBasedOnGit(): void
    {
        $version = VersionHelper::generateLongVersion();
        $versionHash = trim(shell_exec("git log --format='%h' -n 1"));

        $this->assertIsString($version);
        $this->assertStringContainsString("|", $version);
        $this->assertStringContainsString($versionHash, $version);
    }
}
