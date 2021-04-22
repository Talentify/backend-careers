# Talentify - API RESTful

## Rodar a Aplicação
Clone o projeto para o seu ambiente.
Para usá-lo, execute `docker-compose up` na pasta do projeto.

## Testes Automatizados
Para executar os testes, entrar no contaner PHP, usando o comando `docker exec -it talentify-app sh`  
Execute `vendor/bin/phpunit` para rodar os testes.

## Acessar a Aplicação - http://localhost:8000/api/v1/auth/login
Como se trata de uma API RESTful, acessar os endpoints através do Postman ou outro API Client.
Os endereços dos Endpoints estão descritos na documentação.  

Para acessá-los, primeiramente deve ser feita uma requisição para o endpoint de autenticação, enviando no corpo da requisição dados de email e senha do Recrutador cadastrado.
Para fins de testes usar os dados abaixo:
Endpoint de Autenticação: http://localhost:8000/api/v1/auth/login  
email: recrutador@email.com  
password: secret  

De acordo com os requisitos, existem somente 2 endpoints abertos, cujo acesso não precisa de autenticação:
- Listagem pública de vagas abertas - http://localhost:8000/api/v1/positions-open (GET)
- Busca pública de vagas abertas - http://localhost:8000/api/v1/positions-open-search (POST)

A documentação apresenta detalhes dos endpoints.

## Documentação - http://localhost:8000/api/documentation
A documentação que descreve a API RESTful desenvolvida neste projeto pode ser acessada em http://localhost:8000/api/documentation
Esta documentação foi produzida utilizando o Swagger e apresenta em detalhes cada Endpoint, podendo inclusive consumí-los diretamente pela documentação para fazer alguma requisição.

## Segurança
Foi utilizado o pacote JWT-Auth para restringir o acesso aos endpoints.  

## Funcionalidades do Laravel usadas nesta aplicação
- Migrations, Factories, Seeders, Resources, Middlewares.
- Para permitir consumir a API de imediato, sem ter que cadastrar Recrutadores, Empresas e Vagas, executando `docker-compose up`
  pela primeira vez, o `docker-compose.yml` irá executar` php artisan migrate --seed` que criará as tabelas no banco de dados e as gerará com 1 Recrutador, 1 Empresa e 2 Vagas (1 Aberta e 1 Fechada).

## Base de dados
- MySQL
- Eloquent ORM para trabalhar com uma base de dados, onde as tabelas têm um "Modelo" correspondente que se utiliza para interagir com essa tabela.
- O relacionamento é definido nos modelos.

## Padrão de design
- Repository Design Pattern para separar o acesso aos dados da lógica de negócios. Com este padrão temos uma divisão de responsabilidades, 
  deixando cada camada da aplicação o mais simples possível, contribuindo para a aplicação ser escalável mais facilmente. 

## Versionamento
- Foi utilizado como prefixo nos endereços dos endpoints `/api/v1` para permitir o desenvolvimento e publicação de uma nova versão desta API através
do endereço com prefixo `api/v2`, por exemplo, e não impedir o acesso a versão anterior até que seja seguro descontinuá-la.

## Recursos da API
A API RESTful permite:
- Cadastro/Login de recrutadores, onde cada recrutador pertence a uma empresa diferente. De acordo com esse requitiso, a aplicação não permite o cadastro de mais de 1 recrutador em uma mesma empresa.
- CRUD de vagas pelos recrutadores, onde um recrutador não pode editar/excluir vagas criadas por outro
- Listagem pública de vagas abertas.
- Busca pública de vagas abertas com os seguintes critérios: keyword, address, salary e company.  
Com critério keyword a busca pelo termo digitado é feita nos campos address, salary, description, title.
