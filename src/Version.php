<?php

declare(strict_types=1);

namespace Blumilk\Version;

class Version
{
    public const string SCRIPTS_DIRECTORY = "src/scripts/";

    public function __construct(
        public bool $long = false,
    ) {}

    public function setLong(bool $long): void
    {
        $this->long = $long;
    }

    public function generate(): string
    {
        return shell_exec(self::SCRIPTS_DIRECTORY . "check.sh")
            ? $this->getVersionBasedOnGit()
            : $this->getVersionBasedOnTimestamp();
    }

    private function getVersionBasedOnGit(): string
    {
        if ($this->long) {
            return shell_exec(self::SCRIPTS_DIRECTORY . "version.sh --long");
        }

        return shell_exec(self::SCRIPTS_DIRECTORY . "version.sh");
    }

    private function getVersionBasedOnTimestamp(): string
    {
        return (string)time();
    }
}
