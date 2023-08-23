up:
	docker-compose up -d
down:
	docker-compose down
in:
	docker-compose exec php-fpm bash
run:
	php bin/console StartEmailScheduler:command
build:
	docker-compose build
ps:
	docker-compose ps -a
info:
	php bin/console debug:schedule
