#!/bin/sh

docker-compose exec app composer install

docker-compose exec app php artisan key:generate
