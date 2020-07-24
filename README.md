# backend-careers

## Requisitos
- Docker
- Docker-compose

## Como usar

- Clone o projeto
- renomeie **.env.dist** para **.env**
- Atualize o **.env** com as suas informações (port, database....)..
- Execute `docker-compose up -d`
- Logo apos a conclusão execute `docker-compose exec engine sh`
- E dentro do container execute `composer install`
- Em seguida `vendor/bin/phinx migrate -e development` e `vendor/bin/phinx seed:run`
- Acesse **"localhost:80"** navegador (alter para a porta que foi definida para ngix)
- Pronto!
