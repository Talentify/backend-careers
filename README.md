## Talentify application


The application consists of listing active job vacancies, creating vacancies through private access, login and user creation.
    
Dependencies
-------------
* [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
* [Laravel 8.x](https://laravel.com/)
* [PHP 7.4](https://www.php.net/releases/7_4_0.php)
* [Docker](https://docs.docker.com/)
* [Docker-compose](https://docs.docker.com/compose/)


Installation
-------------

- After the clone of the project, cp .env.example to new archive .env and  execute script in the root.
```console
./up.sh
```
Listing active containers.
```console
docker ps
```

Accessing the container terminal.

```console
docker exec -it CONTAINER_ID sh
```

Commands to be executed in the API container.

- Database creation.
```console
php artisan migrate --seed
```

- Database update
````console
php artisan migrate:fresh --seed
````

- Run tests
```
./vendor/bin/phpunit ./tests/
```

- Project url: [localhost:3040](http://localhost:3040)

-------------

Api endpoints
-------------
 
 | Method   | Path                | Public | 
 |--------- |---------------------| ------ |
 | GET      | /api/jobs           |   X    |
 | POST     | /api/jobs           |        |
 | POST     | /api/auth/login     |   X    |
 | POST     | /api/users          |   X    |
 

-------------

Route collection
-------------
Provided by [postman](https://www.postman.com/)

[collection-talentify-rafael-leme](https://documenter.getpostman.com/view/3011439/TVmFizwh)

Note: the sample payload is available in the collection

Rafael Leme, dev.rafael.leme@gmail.com
