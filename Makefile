DOCKER_COMPOSE_FILENAME=docker-compose.yml
PHP_FPM_SERVICE_NAME=php

.PHONY: shell
shell:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} exec ${PHP_FPM_SERVICE_NAME} bash

.PHONY: test
test:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} exec ${PHP_FPM_SERVICE_NAME} composer test

.PHONY: csf
csf:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} exec ${PHP_FPM_SERVICE_NAME} composer csf

.PHONY: run
run:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} up -d

.PHONY: build
build:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} build

.PHONY: stop
stop:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} stop

.PHONY: restart
restart: stop run
