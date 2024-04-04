#!/usr/bin/env sh

isGitRepo() {
  git rev-parse --is-inside-work-tree >/dev/null 2>&1
}

isGitRepo
if [ $? -gt 0 ]; then
  echo "Not a git repository."
  return 0
fi

echo "Git repository detected."
return 1
