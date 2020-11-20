lint:
	./vendor/bin/phplint --no-cache

phpcs:
	./vendor/bin/phpcs -n --ignore=/vendor,/storage,/tests .

phpcbf:
	./vendor/bin/phpcbf --ignore=/vendor,/storage .

test:
	php artisan test