.PHONY: help install run stop test

.DEFAULT_GOAL := help

DOCKER_COMPOSE = docker-compose -p labyrinth-symfony

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


composer-install: ## Run composer install within the host
	$(DOCKER_COMPOSE) run --no-deps --rm \
		php bash -ci 'bin/composer.phar install'

install: composer-install ## Install docker environnement

start: run

run: ## Start the server
	$(DOCKER_COMPOSE) up --force-recreate -d

stop: ## Stop the server
	$(DOCKER_COMPOSE) down

logs:
	$(DOCKER_COMPOSE) logs -f

test: ## Test the code
	$(DOCKER_COMPOSE) run --no-deps --rm php bin/phpunit tests
