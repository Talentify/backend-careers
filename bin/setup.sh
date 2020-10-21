#!/bin/sh

cp .env.example .env

docker-compose run app composer install
docker-compose run app php artisan key:generate
