## Requirements

- PHP 7.3
- MySQL 5.7
- Composer
- Apache2

## Installation

- Connect to your MySQL and create a new database. e.g.: 'talentify'
- In project folder, run:
    - `composer install`
    - `cp .env.example .env`
- Open .env file and edit DB_* vars 
- In project folder, run:
    - `php artisan key:generate`
    - `php artisan migrate`

## Running the application

- In project folder, run: `php artisan serve`

## Endpoints

#### Create a new user

```bash
curl --location --request POST 'http://127.0.0.1:8000/users' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Matheus",
    "email": "matheus@test.com",
    "password": "12345" 
}'
```

#### Login

```bash
curl --location --request POST 'http://127.0.0.1:8000/login' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "matheus@test.com",
    "password": "12345"
}'
```

#### Create a new opportunity

Use the `api_token` in Authorization header, after the word "Bearer"

```bash
curl --location --request POST 'http://127.0.0.1:8000/opportunities' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer {api_token}' \
--data-raw '{
    "title": "Senior Backend PHP Developer",
    "description": "Senior backend php developer opportunity for talentify",
    "status": "OPEN",
    "workplace": "Street 123",
    "salary": 123.45
}'
```

#### List all opportunities

```bash
curl --location --request GET 'http://127.0.0.1:8000/opportunities' \
--header 'Accept: application/json'
```

## Testing

- In project folder, run: `php artisan test`
