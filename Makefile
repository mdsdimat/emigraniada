local-up:
	docker-compose up -d

local-bash:
	docker-compose exec emg-app bash

server-update:
	docker-compose exec emg-app bash -c "php app.php update && /var/server/rr reset"

cs:
	docker-compose exec emg-app bash -c "vendor/bin/spiral-cs check app/src"
