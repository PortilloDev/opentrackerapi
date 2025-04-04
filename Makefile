api_port := 8022

start:
	@docker-compose -f docker-compose-dev.yaml up -d
	@echo 'UpSpain api started at:  http://localhost:$(api_port)'

deploy:
	@docker-compose run app bin/deploy.sh

console:
	@docker-compose exec app bash

stop:
	@docker-compose stop

destroy: stop
	@docker-compose down --rmi all