.PHONY: help install run stop test

.DEFAULT_GOAL := help

DOCKER_COMPOSE = docker-compose -p labyrinth-symfony-development -f docker-compose.yaml -f docker-compose.development.yaml
DOCKER_COMPOSE_TEST = docker-compose -p labyrinth-symfony-test -f docker-compose.yaml -f docker-compose.test.yaml

export $UID = $(id -u)
export $GID = $(id -g)

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install-composer:
	$(DOCKER_COMPOSE) run --no-deps --rm php bash -ci 'bin/composer.phar install'

install-postgres:
	$(DOCKER_COMPOSE) up -d postgres
	$(DOCKER_COMPOSE) run --no-deps --rm php \
		bash -ci './bin/console doctrine:database:create --if-not-exists && ./bin/console doctrine:schema:update --force'
	$(DOCKER_COMPOSE) down

#	$(DOCKER_COMPOSE) exec postgres psql -f schema.sql labyrinth -U labyrinth
#	$(DOCKER_COMPOSE) exec postgres createdb -U labyrinth labyrinth

install-api:
	$(DOCKER_COMPOSE) run --no-deps --rm api ash -ci 'npm install'

install:
	$(MAKE) install-composer
	$(MAKE) install-postgres
	$(MAKE) install-api

start: run
run: ## Start the server
	$(DOCKER_COMPOSE) up --force-recreate -d

stop: ## Stop the server
	$(DOCKER_COMPOSE) down

logs:
	$(DOCKER_COMPOSE) logs -f

test: ## Test the code
	$(DOCKER_COMPOSE_TEST) run --no-deps --rm php bin/phpunit tests

connect-php: # Open bash session in php container as host user
	$(DOCKER_COMPOSE) run --no-deps --rm php bash

connect-postgres: # Open database container
	$(DOCKER_COMPOSE) exec postgres psql labyrinth -U labyrinth

connect-api: # Open ash session in api container
	$(DOCKER_COMPOSE) run --no-deps --rm api ash

log-api:
	docker logs labyrinth-symfony-development_api_1 -f

