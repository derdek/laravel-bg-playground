ifndef DOCKER_COMPOSE_CMD
    ifeq ($(shell command -v docker-compose 2>/dev/null),)
        ifeq ($(shell command -v docker 2>/dev/null),)
            $(error Docker is not installed. Please install Docker.)
        endif
        ifeq ($(shell docker compose 2>/dev/null),)
            $(error Docker Compose is not installed. Please install Docker Compose.)
        else
            DOCKER_COMPOSE_CMD = docker compose
        endif
    else
        DOCKER_COMPOSE_CMD = docker-compose
    endif
endif

start:
	$(DOCKER_COMPOSE_CMD) up -d

stop:
	$(DOCKER_COMPOSE_CMD) down

start-pma:
	$(DOCKER_COMPOSE_CMD) up -d pma

start-worker:
	$(DOCKER_COMPOSE_CMD) up -d worker --build

stop-worker:
	$(DOCKER_COMPOSE_CMD) down worker --timeout 300

spawn-jobs:
	$(DOCKER_COMPOSE_CMD) exec worker sh -c "php artisan spawn-jobs"

start-scheduler:
	$(DOCKER_COMPOSE_CMD) up -d scheduler --build

stop-scheduler:
	$(DOCKER_COMPOSE_CMD) down scheduler

listen-logs:
	$(DOCKER_COMPOSE_CMD) logs -f

start-backend-dev:
	$(DOCKER_COMPOSE_CMD) -f docker-compose-dev.yml up -d

start-migration-dev:
	$(DOCKER_COMPOSE_CMD) -f docker-compose-dev.yml exec backend sh -c "php artisan migrate"

stop-backend-dev:
	$(DOCKER_COMPOSE_CMD) -f docker-compose-dev.yml down
