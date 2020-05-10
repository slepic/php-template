.phony: install test cs-check cs-fix

install:
	docker-compose run --rm php composer install --no-interaction --no-suggest

test:
	docker-compose run --rm php vendor/bin/phpunit

cs-check:
	docker-compose run --rm php vendor/bin/phpcs --standard=PSR2 src tests

cs-fix:
	docker-compose run --rm php vendor/bin/phpcbf --standard=PSR2 src tests

ci: install cs-check test