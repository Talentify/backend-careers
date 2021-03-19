# Documentação Recruit API <h1>

### API para Recrutadores cadastrar e editar suas vagas.
### Autenticação JWT Token Bearer que deverá ser passado em todos endpoints menos o de cadastro dos recrutadores e busca de vagas.

* Xampp ou Laragon
* PHP 7.~
* Mysql -> Criar uma base: recruit_db
* Composer

1. composer update | composer install
2. php artisan serve
3. php artisan migrate

### Opcional:
1. composer require tymon/jwt-auth --ignore-plataform-reqs
2. php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
3. php artisan jwt:secret

### UnitTest:
tests/Unit/RecruiterTest.php
Rodar: ./vendor/bin/phpunit

### Endpoints:

1. Gerar Token (JWT): http://localhost:8000/api/login?email=marcia@gmail.com&password=1234
2. Recuperar Usuario Logado: http://localhost:8000/api/search-login
3. Buscar Todas as Vagas: http://localhost:8000/api/vacancy-all
4. Criar Vaga: http://localhost:8000/api/vacancy-create
6. Busca Filtrada: http://localhost:8000/api/vacancy-show
7. Atualizar Vaga: http://localhost:8000/api/vacancy-update/1
8. Cadastrar Recrutador: http://localhost:8000/api/store-recruiter

<details>
  <summary>POST: Gerar Token (JWT):</summary>
  * Passe por parâmetro na URL o email e senha para fazer o login

  * http://localhost:8000/api/login?email=marcia@gmail.com&password=1234
  
  * Irá gerar um token e esse token será passado como BEARER TOKEN na ultilização dos outros endpoints;
</details>

<details>
  <summary>GET: Recuperar Usuario Logado:</summary>
  * Passe o token pelo Bearer: 

   * http://localhost:8000/api/search-login
</details>

<details>
  <summary>GET: Buscar Todas as Vagas Abertas:</summary> 

    * Não precisa passar o Token Bearer: 

    * http://localhost:8000/api/vacancy-all
    
</details>

<details>
  <summary>POST: Criar Vaga:</summary>

   * Passe o token pelo Bearer: 

   * http://localhost:8000/api/vacancy-create

   * Json:  {
        "title": "Vaga C#",
        "description": "Codar em .Net",
        "status": 0,
        "address": "Sao Paulo-SP",
        "salary": "8.000,00 R$",
        "company": "Empresa Fantasia"
    }
</details>

<details>
  <summary>GET: Busca Filtrada:</summary>
   * Não precisa passar o Token Bearer: 

   * http://localhost:8000/api/vacancy-show

   * Json: {
       "title": "Vaga C#",
        "address": "Sao Paulo-SP",
        "salary": "8.000,00 R$",
        "company": "Empresa Fantasia"
   }

   * Podera ser filtrado usanto todos os parametros do json ou apenas o que escolher.
</details>

<details>
  <summary>PUT: Atualizar Vaga:</summary>
  * Passe o token pelo Bearer: 

  * Verifica se o recrutador logado é o mesmo que criou a vaga selecionada pra atualização: 

   * http://localhost:8000/api/vacancy-update/1

   *Json:  {
        "title": "TechLead Nivel 10",
        "description": "Liderar equipes",
        "status": "Aberto",
        "address": "Sao Paulo-SP",
        "salary": "10.000,00 R$",
        "company": "Talentify"
    }
</details>

<details>
  <summary>POST: Cadastrar Recrutador:</summary>
  * Não precisa passar o Token Bearer: 

   * http://localhost:8000/api/store-recruiter

   * Json  {
        "name": "Marcia",
        "email": "marcia@gmail.com",
        "password": "1234",
        "company_name": "Talentos"
    }
</details>
