<?php

declare(strict_types=1);

namespace Blumilk\Version;

class VersionHelper
{
    public function generate(bool $long = false): string
    {
        if (!$this->isGitInstalled() && !$this->isGitRepository()) {
            return $this->generateVersionBasedOnTimestamp();
        }

        if ($long) {
            return $this->generateVersionWithLongFormat();
        }

        return $this->generateVersionWithShortFormat();
    }

    private function isGitInstalled(): bool
    {
        $output = shell_exec("git --version");

        return !empty(trim($output));
    }

    private function isGitRepository(): bool
    {
        $output = shell_exec("git rev-parse --is-inside-work-tree >/dev/null 2>&1");

        return empty(trim($output));
    }

    private function generateVersionBasedOnTimestamp(): string
    {
        return (string)time();
    }

    private function generateVersionWithLongFormat(): string
    {
        $lastTag = $this->getLastTag();
        $commitCount = $this->getCommitCount();
        $commitHash = $this->getCommitHash();
        $branchInfo = $this->getBranchInfo();

        return "$lastTag|$commitHash-$commitCount$branchInfo";
    }

    private function generateVersionWithShortFormat(): string
    {
        return $this->getLastTag();
    }

    private function getLastTag(): string
    {
        $tag = shell_exec("git describe --tags --abbrev=0 2>/dev/null");

        return $tag ? trim($tag) : "dev";
    }

    private function getCommitCount(): string
    {
        return trim(shell_exec("git rev-list HEAD --count"));
    }

    private function getCommitHash(): string
    {
        return trim(shell_exec("git log --format=\"%h\" -n 1"));
    }

    private function getBranchInfo(): string
    {
        $branchName = $this->getGitBranch();
        $dirtyRepo = $this->isDirtyRepo();

        if ($dirtyRepo || $branchName) {
            return "($branchName$dirtyRepo)";
        }

        return "";
    }

    private function getGitBranch(): string
    {
        $branch = shell_exec("git rev-parse --abbrev-ref HEAD");

        if ($branch !== "main" && $branch !== "master" && $branch !== "HEAD") {
            return trim($branch);
        }

        return "";
    }

    private function isDirtyRepo(): string
    {
        return trim(shell_exec("[ -n \"$(git status -s)\" ] && echo '*'"));
    }
}
