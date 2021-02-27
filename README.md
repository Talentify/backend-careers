## Ambiente Docker

Foi utlizado a arquitetura abaixo para concepção do projeto.

Services, Repository, ACL Dinamica, Testes Unitários, RestFull e Docker.

1. Clonar o repositório:
`git clone https://github.com/nilbertooliveira/backend-careers.git`

2. Acessar a pasta do projeto "docker" e rodar os próximos comandos:
`docker-compose up -d`
    
3. Instalar as dependências:
 ```
docker-compose exec phpfpm composer install
docker-compose exec phpfpm php artisan key:generate
 ```
 
3. Conectar a uma ferramenta de banco como o "DBeaver" e criar o database com o nome "backend-careers":
```
Host: 10.5.0.4
Port: 3306
User: root
Pass: Nil#123@
```
6. Configurar a base de dados
```
docker-compose exec phpfpm php artisan migrate --seed
```
7. Configurar o passport
`docker-compose exec phpfpm php artisan passport:install`

8. Permissoes de pastas
`sudo chmod -R 777 storage/ bootstrap/`

9. Executar testes
`docker-compose exec phpfpm php vendor/bin/phpunit`

## Utilização das APIS
[Documentação Postman](https://documenter.getpostman.com/view/10569259/TWDcGadV)
