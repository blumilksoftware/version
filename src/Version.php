<?php

declare(strict_types=1);

namespace Blumilk\Version;

use Symfony\Component\Process\Process;

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
        return (new Process(["./check.sh"], self::SCRIPTS_DIRECTORY))->run()
            ? $this->getVersionBasedOnGit()
            : $this->getVersionBasedOnTimestamp();
    }

    private function getVersionBasedOnGit(): string
    {
        $process = new Process(["./version.sh"], self::SCRIPTS_DIRECTORY);

        if ($this->long) {
            $process = new Process(["./version.sh", "--long"], self::SCRIPTS_DIRECTORY);
        }

        $process->mustRun();

        return $process->isSuccessful()
            ? $process->getOutput()
            : $this->getVersionBasedOnTimestamp();
    }

    private function getVersionBasedOnTimestamp(): string
    {
        return (string)time();
    }
}
