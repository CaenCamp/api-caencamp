.PHONY: install start stop

help: ## Display available commands
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install php deps
	composer install

start: ## Start dev environment en daemon mode
	symfony server:start -d

stop: ## Stop dev environment
	symfony server:stop
