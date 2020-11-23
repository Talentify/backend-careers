# talentify-backend-carrers


Esse projeto é uma API para consulta e criação de vagas.


## O que é preciso ter instalado?


1. [Docker](https://docs.docker.com/engine/install/)
1. [docker-compose](https://docs.docker.com/compose/install/)


## Instalação do projeto


1. Acesse o diretório raiz do projeto
1. Execute `cp .env .env.local` para criar um arquivo de variáveis de ambiente local
1. Execute `cp .env.test .env.test.local` para criar um arquivo de variáveis de ambiente de teste local
1. Execute `cp phpunit.xml.dist phpunit.xml` para criar um arquivo de configurações do PHPUnit local
1. Execute `cp docker/php/usr/local/etc/php/conf.d/talentify.ini.dist docker/php/usr/local/etc/php/conf.d/talentify.ini` para criar o arquivo de configurações do PHP
1. Edite os arquivos recém criados conforme achar necessário
1. Execute `docker-compose build` para gerar a imagem do container do projeto
1. Execute `docker-compose run --rm php composer install --verbose` para instalar as dependências do projeto
1. Execute `docker-compose run --rm php bin/console doctrine:migration:migrate --no-interaction` para criar a base de dados
1. Execute `docker-compose run --rm php bin/console doctrine:fixtures:load --no-interaction` para carregar alguns dados na base de dados


## Testes unitários e funcionais


1. Acesse o diretório raiz do projeto
1. Execute `docker-compose up test`


Nesse comando, é utilizado o arquivo *.env.test.local* conforme especificado em *docker-compose.yml*.


## Servidor de desenvolvimento


1. Acesse o diretório raiz do projeto
1. Execute `docker-compose up --force-recreate local-server`


Nesse comando, é utilizado o arquivo *.env.local* conforme especificado em *docker-compose.yml*.


---


## Rotas


Os comandos de exemplo estão assumindo **http://localhost:8000** como endereço do servidor, porém, esse endereço pode mudar de acordo com as variáveis de ambiente configuradas.


### POST /auth/credentials


* Essa rota é usada para fazer autenticação com usuário e senha, recebendo as credenciais do usuário como resposta.
* O usuário utilizado nesse exemplo é o usuário carregado na instalação do projeto.


```curl
curl -v -XPOST -H "Content-type: application/json" -d '{"username": "test", "password": "test"}' 'http://localhost:8000/auth/credentials'
```


### GET /auth/logged


* Essa rota é usada para confirmar que o usuário está logado.
* O token utilizado deve ser substituído pelo token recebido na rota `POST /auth/credentials`


```curl
curl -v -XGET -H 'X-AUTH-TOKEN: c89548e0601f27982622af66bc58a562a5feb68754d6c9aa4d03ca072bad82e1' 'http://localhost:8000/auth/logged'
```


### POST /job


* Essa rota é usada para cadastrar uma vaga.
* O token utilizado deve ser substituído pelo token recebido na rota `POST /auth/credentials`


```curl
curl -v -XPOST -H 'X-AUTH-TOKEN: c89548e0601f27982622af66bc58a562a5feb68754d6c9aa4d03ca072bad82e1' -H "Content-type: application/json" -d '{"title":"title","description":"description","status":true,"workplace":{"address":"address","city":"city","state":"state","country":"country"},"salary":100.1}' 'http://localhost:8000/job'
```


### GET /job


* Essa rota é usada para obter a lista de vagas.


```curl
curl -v -xGET 'http://localhost:8000/job'
```