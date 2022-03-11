build:
	docker-compose up -d --build

start:
	docker-compose up -d

force up:
	docker-compose up -d --build --force-recreate

restart:
	docker-compose restart

down:
	docker-compose down

stop:
	docker-compose stop

exec:
	docker exec -ti $(or $(s), $(service)) bash

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test:
	composer exec phpunit tests

test-coverage:
	composer exec phpunit tests -- --coverage-clover build/logs/clover.xml

install:
	composer install

console:
	composer exec --verbose psysh
