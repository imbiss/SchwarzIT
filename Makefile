SHELL := /bin/bash

#-- docker
docker-clean: ## clean up all docker resource
	docker-compose stop
	docker container prune -f
	docker image prune -f
	docker volume prune -f
	docker network prune -f
