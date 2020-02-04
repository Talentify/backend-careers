# Work King

This API is responsible for management of job opportunities, 
you can create new jobs opportunities or apply for this opportunities.

## Install

This System uses Docker, so it is necessary Docker 
and Docker Compose installed to run this project, but you can configure nginx (or apache), php and mysql.

For install is necessary follow this steps:

**Install using Docker**

* Acess the directory of project
* run this command to install libraries
    * docker run --rm --interactive --tty \     
         --volume $PWD:/app \         
         --user $(id -u):$(id -g) \         
         composer install
* run this commands for install and start docker
    * `docker-compose build`
    * `docker-compose up -d`
* run this command for create tables
    * `docker-compose exec php php artisan migrate`
* run this command for create admin user
    * `docker-compose exec php php artisan db:seed`
* give permissions for logs:
    * `sudo chmod 777 -R storage`


**Install without Docker**
* Configure nginx (or apache), php and mysql;
* Acess the directory of project
* run this command to install libraries
    *  `composer install`
* run this command to create tables
    * `php artisan migrate`
* run this command to create admin user
    * `php artisan db:seed`
* give permissions for logs:
    * `sudo chmod 777 -R storage`

## Tests
For run tests follow this steps:
* run this command to create database test:
    * `docker-compose exec php php artisan create-database:test`
* run this command to run acceptance tests:    
    * `docker-compose exec php composer tests`


## Usage
 The token of admin user is 'API_TOKEN', so you need pass in header "token:API_TOKEN".

**Important: The Tokens expires in two hours, you need generate new token in endpoints of login**

**There is a collection of Postman with all routes 
in the main directory of project with name 'Work King.postman_collection.json'**

Access this URL for docs of endpoints (this URL is only if you use Docker to install project):
 
 * **URL:** http://localhost:7080
 
Access this URL for API of endpoints ((this URL is only if you use Docker to install project):
  
  * **URL:** http://localhost:8080

_if you don't use Docker to install system you need configure the URL;_  

_if you don't use Docker to install, follow this steps to generate documentation:_

* _access this site https://editor.swagger.io/_
* _select File -> Import File
    * _select this file (directory of project)/docs/swagger.yaml__

