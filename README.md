# JobsAPI

Esta aplicação consiste em uma API de pubicação e listagem de vagas de emprego, desenvolvida em Lumen. Os endpoints estão no padrão REST.

## Tecnologias Utilizadas

- Docker
- PHP 7.4
- MySQL 5.7
- Lumen-Laravel Framework 8.x
- PHPUnit
- PHP-JWT

## Dados de acesso para o banco de dados
`
DB_CONNECTION=mysql
DB_HOST=talentify-test-mysql
DB_PORT=3306
DB_DATABASE=talentify-test
DB_USERNAME=root
DB_PASSWORD=abc123
`

## Instalação e execução do projeto

- **Passo 1:** na pasta raiz, onde encontra-se o arquivo **docker-compose.yml**, execute:
`docker-compose up -d`
- **Passo 2:** acessar o container PHP
`docker exec -it talentify-test-php-fpm bash`
- **Passo 3** dentro do container do PHP, instalar o composer:
`composer install`
- **Passo 4** executar as migrations para criação das tabelas:
`php artisan migrate`
- **Passo 5** executar os testes unitários:
`vendor/bin/phpunit`

## Endpoints disponíveis

**JOBS**
- `GET - /api/jobs/` - retorna todos os empregos cadastrados
- `GET - /api/jobs/{id}` - retorna um único emprego pelo id
- `POST - /api/jobs/` - insere um novo emprego (necessário estar logado)
- `PUT - /api/jobs/{id}` - altera um emprego existente pelo id (necessário estar logado)
- `DELETE - /api/jobs/{id}` - excluí um emprego existente pelo id

**USERS**
- `POST - /api/users` - insere um usuário para teste de autenticação
- `DELETE - /api/users/{id}` - exclue um usuário pelo id (necessário estar logado)

**AUTH**
- `POST - /api/auth/login` - realiza o login e recebe um Baerer Token para autenticação nas rotas protegidas