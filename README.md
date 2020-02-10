Test Dev
============


## Requisitos

    docker 
    docker-compose

## Instalação do projeto

Acesse a pasta do projeto e rode o comando:

    docker-compose up -d --build

Após subir o container do projeto, instalar as dependencias do projeto:

    docker exec -it -w /var/www/html talentify_web_1 composer install

Copiar .env.example para .env, caso não seja criado automaticamente

    docker exec -it -w /var/www/html talentify_web_1 cp .env.example .env

Rodar migrations:

    docker exec -it -w /var/www/html talentify_web_1 php artisan migrate

Rodar seeds do banco:

    docker exec -it -w /var/www/html talentify_web_1 php artisan db:seed

Gerar chaves do passport:

    docker exec -it -w /var/www/html talentify_web_1 php artisan passport:keys --force


## Testes

    docker exec -it -w /var/www/html talentify_web_1 ./vendor/bin/phpunit
    
## Utilizaçāo da API
    Segue abaixo listagem dos endpoints.
    
    Parâmetros usados nos endpoints de listagem:
        paginate: número de registros por página
        page: número da página
    Necessário adicionar parametros no cabeçalho:
        'Content-Type': 'application/json'
        'Accept': 'application/json'
        

#### Login
    Gerar Token: POST localhost:8001/oauth/token
        Parâmetros de envio: (usuário admin já cadastrado via seed). Substituir username e password de cada usuário novo cadastrado para fazer login com os mesmos
            grant_type:password
            client_id:2
            client_secret:Qh1DDYCd2zun9oWwHK5kVhsPG2t5ruIZF2O8fXgP
            username:admin@admin.com
            password:admin@123
            scope:

#### Jobs
    Listagem: GET localhost:8001/jobs
    Consulta: GET localhost:8001/job/{id} 
    Insercao: POST localhost:8001/job (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}
        Body:
            {
                "title": "teste 3",
                "description": "teste 2 teste 2 ",
                "status": "opened",
                "workplace": "teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 t",
                "salary": 9995569.99
            }
    Atualizacao: PUT localhost:8001/job/{id} (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}
        Body:
            {
                "title": "teste 3",
                "description": "teste 2 teste 2 ",
                "status": "opened",
                "workplace": "teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 teste 2 t",
                "salary": 9995569.99
            }
    Exclusao: DELETE localhost:8001/job/{id} (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}

#### Usuários
    Listagem: GET localhost:8001/users (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}
    Consulta: GET localhost:8001/user/{id} (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}
    Insercao: POST localhost:8001/user 
        Body:
            {
                "name": "teste",
                "lastname": "Teste",
                "email": "test2e2@teste.com",
                "password": "1234@sdasd",
                "password_confirmation": "1234@sdasd"
            }
    Atualizacao: PUT localhost:8001/user/{id} (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}
        Body:
            {
                "name": "teste",
                "lastname": "Teste",
                "email": "test2e2@teste.com",
                "password": "1234@sdasd",
                "password_confirmation": "1234@sdasd"
            }
    Exclusao: DELETE localhost:8001/user/{id} (rota acessada apenas com usuário logado)
        Parâmetros adicionais no cabeçalho:
            Authorization: Bearer {adicionar access_token retornado no login}

