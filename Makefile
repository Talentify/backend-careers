setup:
	docker-compose up -d
	docker exec -it talentify-php-fpm composer install
	docker exec -it talentify-php-fpm php bin/console doctrine:schema:create
	docker exec -it talentify-php-fpm php bin/console doctrine:schema:update --force
	docker exec -it talentify-php-fpm chmod 777 var/talentify.db

start-docker:
	docker-compose up -d

stop-docker:
	docker-compose stop

create-user:
	curl --location --request POST 'localhost:8080/users' --header 'Content-Type: application/json' --data-raw '{ "name": "test", "username": "test.user", "password": "123456", "email": "test@example.com" } '
