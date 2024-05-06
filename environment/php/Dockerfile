ARG PHP_VERSION=8.3.6-cli-bookworm
ARG COMPOSER_TAG_VERSION=2.7.4-bin

FROM composer/composer:${COMPOSER_TAG_VERSION} AS composer_binary

FROM php:${PHP_VERSION}

COPY --from=composer_binary /composer /usr/bin/composer

RUN apt-get update && apt-get install -y git zip \
    && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-enable zip
