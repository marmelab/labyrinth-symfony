.PHONY: help install run stop test

.DEFAULT_GOAL := help

DOCKER_COMPOSE = docker-compose -p labyrinth-symfony-development -f docker-compose.yaml -f docker-compose.development.yaml
DOCKER_COMPOSE_TEST = docker-compose -p labyrinth-symfony-test -f docker-compose.yaml -f docker-compose.test.yaml

export $UID = $(id -u)
export $GID = $(id -g)

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install docker environnement
	$(DOCKER_COMPOSE) run --no-deps --rm \
		php bash -ci 'bin/composer.phar install'
	$(DOCKER_COMPOSE) run --no-deps --rm \
		api ash -ci 'npm install'

start: run
run: ## Start the server
	$(DOCKER_COMPOSE) up --force-recreate -d

stop: ## Stop the server
	$(DOCKER_COMPOSE) down

logs:
	$(DOCKER_COMPOSE) logs -f

test: ## Test the code
	$(DOCKER_COMPOSE_TEST) run --no-deps --rm php bin/phpunit tests
