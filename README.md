# Teste para a vaga de Back-End Talentify
# Autor: Paulo Vinicius Lavoratti

## Introdução

Nesse teste, utilizei o framework Laminas MVC (antigo Zend Framework 3), junto com o Laminas utilizo 
o Doctrine 2 com a função de ORM do BD.

## Instalação

### 1º - Criando database
Dentro da pasta do projeto, existe um arquivo chamado **create_database.sql**. 
Esse arquivo contém o script para a criação da base de dados MySQL, 
caso preferir também tem o arquivo chamado **model_database.mwb** que é o modelo da database.

### 2º - Instalando dependências
Rodar o seguinte comando: composer install

### 3º - Configurar o arquivo .env
Copiar ou renomear o arquivo **.env.example** para **.env**, nesse arquivo é possível 
adicionar os dados de conexão com o BD

### 4º - Postman
Dentro da pasta do projeto, existe um arquivo chamado **Talentify.postman_collection.json**
nesse arquivo contém as rotas da api, para acessar é necessário ter o postman no computador.

### 5º - Projeto
Os Controllers da API estão no seguinte caminho **module/Api/src/Controller**
As Entity estão no seguinte caminho **module/Admin/src/Entity**

### 6º - Rodar projeto
Dentro da pasta do projeto, rodar o seguinte comando **php -S 0.0.0.0:8080 -t public**
Ou **composer serve**

### 7º - Rodar os teste
Para rodar os testes unitários, basta executar o comanto **composer test**


## Instalação

Rotas de testes

### Cadastro de pessoa
**Register Person** - /v1/login/register ou /v1/login/register/1 (update)

**Login** - /v1/login

### Cadastro de vaga
**Register Job** - /v1/jobs/register OU /v1/jobs/register/1 (updated) -- OBS: Autenticação necessária (Bearer Token)

**List Jobs** - /v1/jobs



