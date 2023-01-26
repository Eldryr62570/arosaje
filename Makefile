#----------------------------------------------------------
# Variables
#----------------------------------------------------------
DOCKER_COMP = docker-compose


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
reboot: stop up ## Reboot development environment

## ------- Docker -----------------------------------------
up: ## Start the docker hub
	$(DOCKER_COMP) up -d

stop: ## Stop the docker hub
	$(DOCKER_COMP) stop

down: ## Stop and remove containers
	$(DOCKER_COMP) down --remove-orphans
