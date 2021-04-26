#Configurações necessárias
 - Alterar o nome do arquivo .env.example para .env
 - Alterar no arquivo .env as conexões com banco de dados que será utilizado para rodar a aplicação
 - Criar uma base de dados chamada careers

#Comandos para intalação do sistema
 - rodar o composer
 - gerar a chave de aplicação: php artisan key:generate
 - rodar as migrações com o seed: php artisan migrate --seed

#rotas do sistema
 - /api/v1/recruiter/sign-in - POST
 - /api/v1/recruinter/sign-up - POST
 - /api/v1/job - POST
 - /api/v1/job/_job_id - PUT
 - /api/v1/job/_job_id - GET
 - /api/v1/job/_job_id - DELETE
 - /api/v1/jobs - GET
 - /api/v1/search/jobs?key=value

