# <p align="center">Jobs API written with Lumen</p>
<p align="center"><a href="#"><img src="public/images/image.svg" alt="Logo" width="220" height="213" /></a></p>

### Steps to installation

```bash
cp .env.example .env
```

```bash
docker-compose up -d
```

```bash
docker-compose exec php composer install
```

```bash
http://localhost/
```

### Tests

```bash
docker-compose exec php ./vendor/bin/phpunit
```

### Endpoints

##### Create a new user

```
curl --request POST \
   --url http://localhost/user \
   --header 'Content-Type: application/json' \
   --data '{
 	"name": "Lenadro",
 	"email": "lenadro3@gmail.com",
 	"password": "1234567"
 }'
```

##### Login

```
curl --request POST \
  --url http://localhost/login \
  --header 'Content-Type: application/json' \
  --data '{
	"email": "lenadro@gmail.com",
	"password": "123456"
}'
```

##### Create a new job

```
curl --request POST \
  --url 'http://localhost/job?token=29994a4d5500bf8186d14ba532d79e5571715e0c' \
  --header 'Content-Type: application/json' \
  --data '{
	"title": "PHP Developer",
	"description": "job decription",
	"status": 1
    "workplace": "Wall Street"
    "Salary": 1500
}'
```

##### List Jobs

```
curl --request GET \
  --url http://localhost/job \
  --header 'Content-Type: application/json'
```
