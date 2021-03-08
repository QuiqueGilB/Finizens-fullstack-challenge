SHELL=/bin/sh

.PHONY: install
install:
	docker-compose run composer install
	docker-compose run front npm install

.PHONY: build
build:
	docker-compose run composer install
	docker-compose run front npm install
	docker-compose up -d --build
	docker-compose run php bin/console doctrine:migrations:migrate -n -e dev
	docker-compose run php bin/console doctrine:migrations:migrate -n -e test
	docker-compose run php bin/console doctrine:fixtures:load -n -e dev
	docker-compose run php bin/console doctrine:fixtures:load -n -e test
	@echo Backend: http://localhost:5500
	@echo Frontend: http://localhost:5505


.PHONY: up
up:
	docker-compose up -d

.PHONY: test
test:
	docker-compose run php vendor/bin/behat features
