.PHONY: install start stop

help: ## Display available commands
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install php deps
	composer install

start: ## start dev environment en daemon mode
	symfony server:start -d

stop: ## stop dev environment
	symfony server:stop

logs: ## Display dev server logs
	symfony server:log

test: ## Start tests
	php bin/phpunit

contract: ## Extract OpenAPI contract in yaml
	php bin/console api:openapi:export --yaml --output=public/openapi.yaml
	php bin/console api:openapi:export --output=public/openapi.json

db-start: ## start PostgreSQL in Docker Compose
	docker-compose up -d

db-stop: ## stop Docker Compose PG
	docker-compose down

db-logs: ## Display pg logs from Docker Compose
	docker-compose logs -f
