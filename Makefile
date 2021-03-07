SHELL=/bin/sh

.PHONY: install
install:
	docker-compose run composer install

.PHONY: build
build:
	docker-compose up -d --build
	docker-compose run composer install
	docker-compose run php bin/console doctrine:migrations:migrate -n -e dev
	docker-compose run php bin/console doctrine:migrations:migrate -n -e test
	docker-compose run php bin/console doctrine:fixtures:load -n -e dev
	docker-compose run php bin/console doctrine:fixtures:load -n -e test

.PHONY: up
up:
	docker-compose up -d

.PHONY: test
test:
	docker-compose run php vendor/bin/behat features
