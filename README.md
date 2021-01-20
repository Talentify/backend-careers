## Introduction
Boa Noite, neste teste, busquei trazer um pouco do meu conhecimento com o Lumen, um microframework baseado em Laravel.

## Como Instalar?
1. `cp ./app/.env.example ./app/.env` Arquivo .env.example já está configurado corretamente :D
2. `docker-compose up -d`
3. `docker-compose exec app /install.sh`

## Utilizando as APIs
Acesse a documentação disponível em http://localhost:9145/docs assim, que acessar, você pode optar em rodar os comandos no seu terminal ou no Insomnia.

A Primeira rota que você deve acessar é a Login, para gerar seu token de acesso JWT.


## Usuários Disponíveis para Login

### Admin
Email: admin.active@example.net
Pass: admin@1234556

### Admin inativo
Email: admin.inactive@example.net
Pass: admin@654321

### Company
Email: company@example.net
Pass: company@1234556


