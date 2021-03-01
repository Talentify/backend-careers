
init: clean build start migrate

migrate:
	- docker exec -it talentify-api /var/www/html/bin/cake migrations migrate
build: 
	- docker-compose build
start: 
	- docker-compose up -d
stop: 
	- docker-compose stop
clean: 
	- docker-compose rm && docker volume rm volumemysql
test: 
	- docker exec -it talentify-api /var/www/html/vendor/bin/phpunit
bash: 
	- docker exec -it talentify-api /bin/bash