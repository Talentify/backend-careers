# Recruitment Platform

##### Dependências
- docker
- docker-compose
- make
___

## Instalação
1. Faça o clone do repositório com `git clone git@github.com:vivianequinaia/backend-careers.git`.
2. Copie o arquivo .env.dist para .env `cp .env.dist .env`.
3. Utilize o comando `docker-compose build` para realizar o pull das imagens.
4. Execute o comando `docker network create recruitment-platform-network` (utilize o valor variável `NETWORK_DEFAULT` do seu .env);
5. Execute seus containers com o comando `docker-compose up -d`.
6. Entre no container do php `make php` e execute o comando `composer install`.
7. Ainda dentro do container do passo 6 execute o comando `php artisan key:generate` para gerar o valor da variável `APP_KEY`.
8. execute o comando `php artisan migrate` para criar as tabelas do banco de dados.
9. execute o comando `php artisan db:seed` para criar dados no banco de dados.
10. Dê permissão para os arquivos da pasta `/storage`. `sudo chmod 777 -R storage/`.
___

## Postman
A collection para acessar os endpoints via postman se encontram em:

[postman_collection](./storage/recruitment-platform.postman_collection.json).

Saiba mais sobre o postman em: [Postman](https://www.postman.com/)

Utilize o token gerado no Login nos headers das rotas que não são públicas.
___

## Testes unitários:

Para executar os testes unitários:

`make test`, fora do container ou, `./vendor/bin/phpunit tests/` após executar `make php`.
___

## Version
[version](./VERSION).
___

## Sobre a arquitetura do código acesse o artigo abaixo
[A decoupled PHP architecture inspired by the Clean Architecture](https://medium.com/engenharia-arquivei/a-decoupled-php-architecture-inspired-by-the-clean-architecture-788b30ab52c2).
