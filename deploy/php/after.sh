#!/bin/bash
cd /var/www/html
chmod -R 775 storage
chmod -R 775 public/*
chmod -R gu+w storage
chmod -R guo+w storage
php artisan cache:clear
composer install
php artisan migrate
