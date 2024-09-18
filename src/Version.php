<?php

declare(strict_types=1);

namespace Blumilk\Version;

use Symfony\Component\Process\Process;

class Version
{
    public const string SCRIPTS_DIRECTORY = __DIR__ . "/scripts/";
    public const string PATH_TO_VERSION_SCRIPT = "cd ../../../ && ./version/src/scripts/version.sh";
    public const string PATH_TO_CHECK_SCRIPT = "cd ../../../ && ./version/src/scripts/check.sh";

    public function __construct(
        public string $pathToVersionScript = self::PATH_TO_VERSION_SCRIPT,
        public string $pathToCheckScript = self::PATH_TO_CHECK_SCRIPT,
        public bool $long = false,
    ) {}

    public function setLong(bool $long): void
    {
        $this->long = $long;
    }

    public function generate(): string
    {
        return (new Process(["sh", "-c", $this->pathToCheckScript], self::SCRIPTS_DIRECTORY))->run()
            ? $this->getVersionBasedOnGit()
            : $this->getVersionBasedOnTimestamp();
    }

    private function getVersionBasedOnGit(): string
    {
        $process = new Process(["sh", "-c", $this->pathToVersionScript], self::SCRIPTS_DIRECTORY);

        if ($this->long) {
            $process = new Process(["sh", "-c", "$this->pathToVersionScript --long"], self::SCRIPTS_DIRECTORY);
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
