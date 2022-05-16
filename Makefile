up: docker-up
down: docker-down
init: docker-up composer-install migrations fixtures
restart: docker-down docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

composer-install:
	docker-compose run --rm php-cli composer install

migrations:
	docker-compose run --rm php-cli php bin/console doctrine:database:create --if-not-exists
	docker-compose run --rm php-cli php bin/console doctrine:migrations:migrate --no-interaction

fixtures:
	docker-compose run --rm php-cli php bin/console doctrine:fixtures:load --no-interaction

_env_build:
	rm -rf ./.env
	cp ./.env.dist ./.env
