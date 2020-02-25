## Sobre o Projeto
    Aplicação para a publicação de vagas de emprego
    
## Instalação do Projeto
    
Arquivo para conexão com banco de dados

    Copie ou renomeie o arquivo .env.example para .env na raiz do projeto (Caso o arquivo ainda não esteja no projeto)
    
    # Exemplo da configuração do banco de dados
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=talentify
    DB_USERNAME=root
    DB_PASSWORD=
    
Acesse o MySQL e crie o banco de dados (Pode ser utilizado outros banco de dados, basta somente parametrizar no arquivo .env)
    
    create database talentify
    
Digite o comando na raiz do projeto para gerar a chave da aplicação

    php artisan key:generate
    
Digite o comando na raiz do projeto para executar  as migrations para a criação das tabelas do banco de dados

    php artisan migrate
    
Digite o comando na raiz do projeto para executar as seeds para a inserção dos registros nas tabelas

    php artisan db:seed
    
Digite o comando na raiz do projeto para subir a aplicação
    
    php artisan serve

## Utilização do Sistema
    Acessar o endpoint => localhost:8000/login
    
    Usuário Administrador: Login: admin@admin.com | Senha: admin
        * Acesso para cadastrar e editar novas vagas
    
    Usuário Candidato: Login: user@user.com | Senha: user
        * Acesso para visualizar informações somente para usuários logados e permissão para se candidatar as vagas
## Testes
    Digite o comando na raiz do projeto executar os testes unitários
    ./vendor/bin/phpunit (Foi configurado no arquivo phpunit.xml que está na raiz o projeto o banco de dados MySQL)

##Navegação

    Página Inicial (Vagas Ativas): http://localhost:8000
    Página Login: http://localhost:8000/login
    Cadastro Usuário: http://localhost:8000/user/register
    Cadastro Vaga (Somente Admin): http://localhost:8000/admin/jobs/create
    Visualizar Vagas Cadastradas (Somente Admin): http://localhost:8000/admin/jobs
    Dashboard (Somente Admin): http://localhost:8000/admin
    
