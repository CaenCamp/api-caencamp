.PHONY: install start stop

help: ## Display available commands
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install php deps
	composer install

start: ## Start dev environment en daemon mode
	symfony server:start -d

stop: ## Stop dev environment
	symfony server:stop

logs: ## Display dev server logs
	symfony server:log

test: ## Start tests
	php bin/phpunit

contract:
	php bin/console api:openapi:export --yaml --output=openapi_contract.yaml
