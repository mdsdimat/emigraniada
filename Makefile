local-up:
	docker-compose up -d

local-stop:
	docker-compose stop

local-bash:
	docker-compose exec main-app bash

server-update:
	docker-compose exec main-app bash -c "php app.php update && /app/rr reset"

main-test:
	docker-compose exec main-app bash -c "vendor/bin/codecept run"

coverage-report:
	docker-compose exec main-app bash -c "vendor/bin/phpunit --coverage-html coverage-report"

cs:
	docker-compose exec emg-app bash -c "vendor/bin/spiral-cs check app/src"
