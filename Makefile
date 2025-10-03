DOCKER_COMPOSE_BASE = docker compose -f docker/docker-compose.yaml
DOCKER_COMPOSE_RUN  = $(DOCKER_COMPOSE_BASE) run --rm app
DOCKER_COMPOSE_BUILD = $(DOCKER_COMPOSE_BASE) build app

.PHONY: build install update run-solution run-original test cs fix-cs

default: help

build:
	@echo "Building Docker image..."
	$(DOCKER_COMPOSE_BUILD)

install:
	@echo "Installing Composer dependencies..."
	$(DOCKER_COMPOSE_RUN) install

update:
	@echo "Updating Composer dependencies..."
	$(DOCKER_COMPOSE_RUN) update

run-solution:
	@echo "Running solution..."
	$(DOCKER_COMPOSE_RUN) run-solution

run-original:
	@echo "Running original code..."
	$(DOCKER_COMPOSE_RUN) run-original

test:
	@echo "Running PHPUnit tests..."
	$(DOCKER_COMPOSE_RUN) test

coverage-report:
	@echo "Generating code coverage report..."
	$(DOCKER_COMPOSE_RUN) coverage-report

mutation-report:
	@echo "Generating mutation testing report..."
	$(DOCKER_COMPOSE_RUN) mutation-report

cs:
	@echo "Checking code style (PHPCS)..."
	$(DOCKER_COMPOSE_RUN) cs

fix-cs:
	@echo "Fixing code style (PHPCBF)..."
	$(DOCKER_COMPOSE_RUN) fix-cs
