<?php

declare(strict_types=1);

use Blumilk\Version\VersionHelper;
use PHPUnit\Framework\TestCase;

class GenerateVersionTest extends TestCase
{
    public function testGeneratingVersionBasedOnGit(): void
    {
        $version = (new VersionHelper())->generate();

        $this->assertIsString($version);
        $this->assertStringNotContainsString("|", $version);
    }

    public function testGeneratingLongVersionBasedOnGit(): void
    {
        $version = (new VersionHelper())->generate(true);
        $versionHash = trim(shell_exec("git log --format='%h' -n 1"));

        $this->assertIsString($version);
        $this->assertStringContainsString("|", $version);
        $this->assertStringContainsString($versionHash, $version);
    }
}
