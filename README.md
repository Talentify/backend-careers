## About Project

Talentify is an api that offers job openings and job registration

## Tools
 
- **[Tests with phpunit](https://phpunit.de/)** 
- **[Laravel Framework](https://laravel.com/)** 
- **[Jwt Authentication](https://jwt.io/)** 

## Config Project

You need to configure the .env file steps

- config your database in .env, more information about database in docker-compose.yml

## Run Project
- docker-composer up -d
- php artisan key:generate
- php artisan jwt:secret
- php artisan migrate
- php artisan config:clear

## Run Tests

- php artisan test


## Endpoints

#### User

- POST   | api/v1/login
- POST   | api/v1/registrations

#### Product

- GET    | api/v1/index
- GET    | api/v1/show/{id}
- POST   | api/v1/create
- PUT    | api/v1/update/{id}
- DELETE | api/v1/delete/{id}


