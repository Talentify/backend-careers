
init: clean build start
migrate:
	- docker exec -it talentify-api /var/www/html/bin/cake migrations migrate
doc:
	- docker exec -it talentify-api apidoc -i /var/www/html/src/Controller -o /var/www/html/webroot/apidoc/
build:
	- docker-compose build
start:
	- docker-compose up -d
stop:
	- docker-compose stop
clean: stop
	- docker-compose rm && docker volume rm api_volumemysql
test:
	- docker exec -it talentify-api /var/www/html/vendor/bin/phpunit
bash:
	- docker exec -it talentify-api /bin/bash
fix:
	- sudo chown -R paulo src && sudo chown -R paulo config && sudo chown -R paulo tests
