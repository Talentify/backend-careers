# Get Aboard  
Get Aboard is a vacancy announciment sample app, which contains the following functions:
1. Publish a vacancy
1. Update a vacancy
1. Login/Logout (/admin to use it)
1. Paginated list of all valid vacancies

## Get started

1. Installing dependencies
1. Configuring database connection
1. Importing database
1. Configuring your serve
1. Testing your app
1. About

### 1. Installing dependencies
All non shipped dependencies are included in composer.json file. Run this command under your project root path in your favorite shell:
```bash
$ composer install
```

### 2. Configuring database connection
Go to config/app.php and set your database configure
```
return [
'Datasources' => [
  'default' => [
    'className' => Connection::class,
    'driver' => Mysql::class,
    'persistent' => false,
    'host' => '{HOSTNAME}',
    /*
     * CakePHP will use the default DB port based on the driver selected
     * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
     * the following line and set the port accordingly
     */
    //'port' => 'non_standard_port_number',
    'username' => '{USERNAME}',
    'password' => '{PASSWORD}',
    'database' => '{DATABASENAME}',
  ],
  'test' => [ // Connection to be used in test routines
    'className' => Connection::class,
    'driver' => Mysql::class,
    'persistent' => false,
    'host' => '{HOSTNAME}',
    /*
     * CakePHP will use the default DB port based on the driver selected
     * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
     * the following line and set the port accordingly
     */
    //'port' => 'non_standard_port_number',
    'username' => '{USERNAME}',
    'password' => '{PASSWORD}',
    'database' => '{TEST_DATABASENAME}',
  ]
];
```

### 3. Importing database
Get Aboard uses [Phinx](https://phinx.org) for database migration.
#### 3.1 Import scheme
```bash
$ bin/cake migrations migrate
```
#### 3.2 Populate
```bash
$ bin/cake migrations seed --seed InitialSeed
```
### 4. Configuring your server
CakePHP requires a server setup to emulate a domain.
1. NGINX sample
```
server {
  listen 80;
  listen [::]:80;
  server_name blog.local;
  client_max_body_size 24M;

	root {{PATH_TO_PROJECT}}/webroot;
	index index.php;
	location / {
		try_files $uri $uri/ /index.php?$args;
	}

	location ~ \.php {
		fastcgi_split_path_info ^(.+?\.php)(/.*)$;
		if (!-f $document_root$fastcgi_script_name) {
				return 404;
		}
		#PHP 7.2
		fastcgi_pass 127.0.0.1:9000;
		fastcgi_param SCRIPT_FILENAME $request_filename;
		fastcgi_param BLOG $sub;
		include fastcgi_params;
	}
}
```
2. Restart your server
3. Add it to your hosts file

### 5. Get start using it!
Admin: /admin
User: tester@testing.local
Password: 123456

### 6. Testing your app
```bash
$ vendor/bin/phpunit tests/TestCase
```

### 7. About
**How long did it take get "Get Aboard" built from the ground?**  
Only 2h50 hours (including this very Readme file)  

**Used technologies**
  * CakePHP 3.8
  * Composer
  * MySQL 5.7
  * Phinx
  * HTML 5
  * PHP 7
  * jQuery 3
  * PHP Unit 5
  * Twitter Bootstrap 4  

**Requirements**
  * MySQL 5.7/Maria Database installed
  * PHP 7.2+ (with libraries intl, json, mbstring)
  * NGINX or Apache
  * Shell interface (for testing and manual database installation)  
  * Composer  

**More in**

* [CakePHP 3](book.cakephp.org/3.0/en/index.html) - The CakePHP user documentation; start learning here!
