# Talentify API

## Stack

1. Docker
1. PHP 7.4
2. Mysql 8
3. CakePHP4


## Requisitos para rodar o projeto

1. Docker
2. docker-compose
3. Comando ```make``` instalado para facilitar a execução dos comandos.


## Rodar Aplicação

1. Clonar o projeto
2. Dentro da raiz do projeto executar ```make init```
3. Aguarde os containers iniciarem (na primeira vez o banco de dados demora um pouco mais para iniciar)
4. Executar na raiz ```make migrate``` para executar as migrations e criar o banco de dados
5. Acessar http://localhost:8080

## Execução dos testes
Após subir os containers executar os testes utilizando PHPUNIT  com o comando ```make test``` na raiz do projeto.


## OBS.
Caso não possua o make instalado pode executar os comandos diretamente:

1. make init
```
docker-compose build && docker-compose up -d
```
2. make migrate
```
docker exec -it talentify-api /var/www/html/bin/cake migrations migrate
```
3. make test
```
docker exec -it talentify-api /var/www/html/vendor/bin/phpunit
```
