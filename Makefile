default: $(MAKE) startup

dockerize:
	docker-machine start

startup:
	docker-compose up -d

stop:
	docker-compose down --remove-orphans

restart:
	$(MAKE) stop
	$(MAKE) startup

cleanup:
	docker system prune -a


testing:
	docker-compose -f build.yml run --rm php-cli ./app/vendor/bin/phpunit -c /app/phpunit.xml

composer:
	docker-compose -f build.yml run --rm composer install

composer_update:
	docker-compose -f build.yml run --rm composer update