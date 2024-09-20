[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/blumilksoftware/version?style=for-the-badge)](https://packagist.org/packages/blumilksoftware/version)
[![Packagist Version](https://img.shields.io/packagist/v/blumilksoftware/version?style=for-the-badge)](https://packagist.org/packages/blumilksoftware/version)
[![Packagist Downloads](https://img.shields.io/packagist/dt/blumilksoftware/version?style=for-the-badge)](https://packagist.org/packages/blumilksoftware/version/stats)

## blumilksoftware/version
A versioning based on git for all Blumilk projects. If Git is not available, it falls back to the timestamp.

### Usage
Add package to the project:
```shell
composer require blumilksoftware/version
```

Add to your composer.json file:
```json
{
    "scripts": {
        "post-install-cmd": [
          "chmod +x vendor/blumilksoftware/version/src/scripts/version.sh",
          "chmod +x vendor/blumilksoftware/version/src/scripts/check.sh"
        ],
        "post-update-cmd": [
          "chmod +x vendor/blumilksoftware/version/src/scripts/version.sh",
          "chmod +x vendor/blumilksoftware/version/src/scripts/check.sh"
        ]
    }
}
```
It will make the scripts executable after each install or update.

Then use the `Version` class to generate version strings based on Git or timestamp:
```php
<?php

declare(strict_types=1);

use Blumilk\Version\Version;

$version = (new Version())->generate();
```

#### Configuration
You can configure the `Version` class to generate long version strings:
```php
<?php

declare(strict_types=1);

use Blumilk\Version\Version;

$version = (new Version(true))->generate();
```
#### Helper class
You can use also the `VersionHelper` class to generate version strings:
```php  
<?php

declare(strict_types=1);

use Blumilk\Version\VersionHelper;

$shortVersion = VersionHelper::generateShortVersion();
$longVersion = VersionHelper::generateLongVersion();
```
### Contributing
In a cloned or forked repository, run:
```shell
composer install
```

There are scripts available for package codestyle checking and testing:

| Command         | Description                                                  |
|-----------------|--------------------------------------------------------------|
| `composer cs`   | Runs codestyle against the package itself                    | 
| `composer csf`  | Runs codestyle with fixer enabled against the package itself | 
| `composer test` | Runs all test cases                                          | 

There is also the Docker Compose configuration available:
```shell
docker compose up -d
docker compose exec php php -v
docker compose exec php composer -v
```

There are also Makefile commands available:
```shell
make run
make shell
make test
make csf
make stop
```

Please maintain our project guidelines:
* keep issues well described, labeled and in English,
* add the issue number to all your commits,
* add the issue number to your branch name,
* squash your commits into one commit with a standardized name.
