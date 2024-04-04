<?php

declare(strict_types=1);

use Blumilk\Version\Version;
use PHPUnit\Framework\TestCase;

class GenerateVersionTest extends TestCase
{
    public function testGeneratingVersionBasedOnGit(): void
    {
        $version = (new Version())->generate();

        $this->assertIsString($version);
        $this->assertStringNotContainsString("|", $version);
    }

    public function testGeneratingLongVersionBasedOnGit(): void
    {
        $version = (new Version(true))->generate();
        $versionHash = trim(shell_exec("git log --format='%h' -n 1"));

        $this->assertIsString($version);
        $this->assertStringContainsString("|", $version);
        $this->assertStringContainsString($versionHash, $version);
    }

    public function testGeneratingVersionNotBasedOnGit(): void
    {
        $versionHash = trim(shell_exec("git log --format='%h' -n 1"));
        $now = date("Y-m-d");

        $versionHelperMock = $this->getMockBuilder(Version::class)
            ->onlyMethods(["generate"])
            ->getMock();

        $versionHelperMock->expects($this->once())
            ->method("generate")
            ->willReturn((string)time());

        $version = $versionHelperMock->generate();

        $this->assertIsString($version);
        $this->assertStringNotContainsString("|", $version);
        $this->assertStringNotContainsString($versionHash, $version);
        $this->assertSame($now, date("Y-m-d", (int)$version));
    }
}
