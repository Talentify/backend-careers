EXECUTABLE=

ifeq ($(OS),Windows_NT)
	EXECUTABLE=winpty
endif

build: ## Build backend image
	docker-compose build

install: ## Run composer, install vendor
	make build && docker-compose up -d && $(EXECUTABLE) docker-compose exec backend bash -c "php -r \"file_exists('.env') || copy('.env.example', '.env');\" && composer install && php bin/console doctrine:migrations:migrate -q && php bin/console doctrine:fixtures:load -q"

start: ## Up containers in dev mode
	export NGINX_ENV=dev && docker-compose up -d

stop: ## Stop containers
	docker-compose stop

shell: ## Access bash in, backend container
	docker-compose exec backend bash

clear: ## Start and clear
	clear && make start

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help
