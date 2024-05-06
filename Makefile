.PHONY: shell
shell:
	docker compose exec php bash

.PHONY: test
test:
	docker compose exec php composer test

.PHONY: csf
csf:
	docker compose exec php composer csf

.PHONY: run
run:
	docker compose up -d

.PHONY: build
build:
	docker compose build

.PHONY: stop
stop:
	docker compose stop

.PHONY: restart
restart: stop run
