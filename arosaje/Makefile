#----------------------------------------------------------
# Variables
#----------------------------------------------------------
EXEC_PHP    = $(DOCKER_COMP) exec -T php
BASH_PHP	= $(DOCKER_COMP) exec php sh
SYMFONY     = $(EXEC_PHP) bin/console
COMPOSER    = $(DOCKER_COMP) run --rm composer

COMMANDS_W_ARGS = add addev update require reqdev
SUPPORTS_MAKE_ARGS = $(findstring $(firstword $(MAKECMDGOALS)), $(COMMANDS_W_ARGS))
ifneq ($(SUPPORTS_MAKE_ARGS), "")
  COMMAND_ARGS = $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  $(eval $(COMMAND_ARGS):;@:)
endif


.DEFAULT_GOAL := help
help:  ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help

## ------- Project ----------------------------------------
start: dmm dfl ## Initialize the project

## ------- Symfony ---------------------------------------
sf: ## List all Symfony commands
	$(SYMFONY)

cc: ## Clear the cache
	$(SYMFONY) cache:clear 

purge: ## Purge cache and logs
	rm -rf var/cache/* var/logs/*

## ------- Composer --------------------------------------
install: ## Install vendors according to the current composer.lock file
	$(COMPOSER) install --no-progress --prefer-dist

update: composer.json ## Update vendors according to the composer.json file
	$(COMPOSER) update $(COMMAND_ARGS)

require: ## Followed by package name to add it.
	$(COMPOSER) require $(COMMAND_ARGS)

require_dev: ## Followed by package name to add it in require-dev.
	$(COMPOSER) require --dev $(COMMAND_ARGS)


## ------- Doctrine --------------------------------------
dmm: ## Execute migrations
	$(SYMFONY) doctrine:migration:migrate --no-interaction

dfl: ## Load fixtures
	$(SYMFONY) doctrine:fixture:load --no-interaction

dmg: ## Generate a blank migration class
	$(SYMFONY) doctrine:migrations:generate

## ------- Tools -----------------------------------------
bp: ## Bash into php container
	$(BASH_PHP)

