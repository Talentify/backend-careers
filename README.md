## Project Dependencies
```composer install```

## Database
Default database driver for this project is SQLite
to install on Linux run command:  
```sudo apt-get install php7.1-sqlite3```

OR if use MySQL, change DB_CONNECTION in .env file (on root folder)\
example: **DB_CONNECTION=sqlite** -> **DB_CONNECTION=mysql**\
and uncomment config of username, password and database\
\
And run the migrations\
```php artisan migrate:fresh && php artisan db:seed```

## Run Server   
```php -S localhost:8000 -t public``` \ [http://localhost:8000](http://localhost:8000)

## Documentation And Test Interface (Swagger)
[http://localhost:8000/documentation/](http://localhost:8000/documentation/)

## Run Tests
```vendor/bin/phpunit tests/app```

Admin Credentials\
email: **admin@system.local**\
password: **password**
