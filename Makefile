setup-dev:
	docker-compose build --no-cache
	composer install
	docker-compose up -d
	docker exec -it books_catalog_php_fpm /bin/sh -c "php bin/console doctrine:migrations:migrate --no-interaction"

build:
	docker-compose build --no-cache

up:
	docker-compose up -d

kill:
	docker-compose kill

down:
	docker-compose down
