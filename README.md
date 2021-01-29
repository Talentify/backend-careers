## Tiago Perrelli Telentify Project

## Clone the project
```
git clone {url}
```

## Install everything
````
composer install
````

## Run all migrations with seeder
```
php artisan migrate --seed
``` 

## Create password passport client 
```
php artisan passport:client --password
```

## Run all tests
./vendor/phpunit/phpunit/phpunit

## Serve the project
```
php -S 127.0.0.1 -t public
```

### Auth endpoint
[POST] - 127.0.0.1/oauth/token
[PARAMS]
{
	"grant_type": "password",
	"username": "tiago@gmail.com",
	"password": "123456",
	"client_id": "{client_id}",
	"client_secret": "{client_secret}"
}

### Jobs endpoints
[GET] - 127.0.0.1/api/jobs - all jobs
[GET] - 127.0.0.1/api/jobs - all open jobs
[POST] - 127.0.0.1/api/jobs - creates a job
[GET] - 127.0.0.1/api/jobs/{id} - retrieve a job
[PUT] - 127.0.0.1/api/jobs/{id} - update an existing job