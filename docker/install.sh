#!/bin/sh

cd /app

composer install && php artisan migrate && php artisan db:seed
