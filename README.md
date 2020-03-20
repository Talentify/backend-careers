#Teste Talentify

##Introdução

Este projeto foi desenvolvido utilizando o framework Laravel com um esqueleto configurado por mim para agilizar o inicio do desenvolvimento de minhas aplicações.

O projeto conta com uma API Restfull para autenticação JWT, cadastro e listagem de vagas.

Para executar o projeto é necessário ter a biblioteca `docker-compose` instalada.

##Configuração Inicial

- Clonar o projeto localmente
- Copiar o conteúdo do arquivo `.env.example` para o arquivo `.env`
- Alterar, se necessário, as configurações de ambiente local listadas no arquivo `.env`
- Executar o comando `docker-compose build --no-cache` para construir os containers necessários
- Executar o arquivo `start-docker.sh` para iniciar os containers e se logar no servidor de PHP
- Executar o comando `composer install` para instalar as dependências
- Executar o comando `php artisan key:generate` para definir a chave da aplicação
- Executar o comando `php artisan passport:install` para definir a chave de autenticação
- Executar o comando `php artisan migrate` para criar a estrutura do banco de dados    
- Executar o comando `php artisan db:seed` para popular as tabelas do banco de dados com os dados pré-definidos
- Acessar a API através do IP e porta definidos anteriormente no arquivo `.env`

##Credênciais predefinidas 

Para simplificar o escopo do projeto, só foram implementados os itens descritos como requisitos. Portanto, para fazer login
no sistema é necessário utilizar as credenciais abaixo listadas ou criar novas diretamente no código.

Usuário: `teste@talentify.com`

Senha: `talentify` 

##Rotas da API 

###Login: 
[POST] `api/v1/auth/login`

Parâmetros: email, password

###Logout: 
[POST][JWT AUTH] `api/v1/auth/login`

###Criar Vaga
[POST][JWT AUTH] `api/v1/positions`

Parâmetros: 
- `title` Requerido, String
- `description` Requerido, String
- `status` Requerido, Enum: 1 Vaga criada, 2 Recebendo entrevistas, 3 Concluída, 4 Cancelada
- `workplace` Opcional, String
- `salary` Opcional, Float

###Listar vagas
[GET] `api/v1/positions`
