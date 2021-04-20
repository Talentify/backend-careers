# TALENTIFY_API

Implementação de uma API REST utilizando o framework LARAVEL

### Começando

Essas instruções fornecerão uma cópia do projeto em funcionamento em sua máquina local para fins de desenvolvimento e teste. Leia o conteúdo a seguir para fazer a instalação e permitir o funcionamento da aplicação

### Pré-requisitos

Primeiramente você precisa ter o composer instalado em sua máquina: [https://getcomposer.org/download/](https://getcomposer.org/download/)

Com o composer já instalado, faça o download do repositório: 

```
git clone https://github.com/eidercarlos/backend-careers.git
```

Em seguida, dentro do diretório backend-careers faça um chekout no branch eider_carlos

```
git checkout eider_carlos
```

### Instalando

Tenha já a instalação do Laravel em sua máquina:

```
  composer global require laravel/installer
```

Entre na pasta talentify_api e faça a instalação/atualização das dependências:

```
composer update
```

Em seguida, dentro da mesma pasta talentify_api, a partir do arquivo .env.example crie um novo arquivo com o nome .env e defina as configurações locais 
do seu banco de dados MySQL

``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=talentify_api_db
DB_USERNAME=root
DB_PASSWORD=
```

Não esqueça de também gerar uma KEY para a sua aplicação

```
php artisan key:generate
```

Se não houver nenhum problema ao acionar o comando abaixo, significa que a aplicação está OK

```
php artisan serve
```

Agora vamos fazer a migração das nossas tabelas do banco de dados e também vamos popular com alguns registros:

```
php artisan migrate:fresh --seed
```

Caso todos os passos acima tenha ocorridos com sucesso, temos a nossa API REST funcionando.

Os testes unitários podem ser acionados com o seguinte comando:

```
php artisan test
```

## Principais Arquivos/Classes

### EndPoints da API (talentify_api -> routes)

* api.php

//-----------------------------------PUBLIC-----------------------------
//Recruiter
[http://localhost:8000/api](http://localhost:8000/api/login)
Route::post('/login', [RecruiterController::class, 'login']);

//Job
Route::get('/jobs', [JobController::class, 'getall']);
Route::get('/openjobs', [JobController::class, 'getopen']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::post('/jobsfilter', [JobController::class, 'filter']);


//-----------------------------------PROTECTED-----------------------------
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    //Recruiter
    Route::post('/register', [RecruiterController::class, 'register']);
    Route::post('/logout', [RecruiterController::class, 'logout']);

    //Company
    Route::get('/companies', [CompanyController::class, 'getall']);
    Route::get('/companies/{company}', [CompanyController::class, 'show']);
    Route::post('/companies', [CompanyController::class, 'store']);

    //Job
    Route::post('/jobs', [JobController::class, 'store']);
    Route::put('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'delete']);
});


### Arquivos de Model (talentify_api -> app -> Models)

* Company.php
* Job.php
* Recruiter.php

### Arquivos de Controller (talentify_api -> Http -> Controllers)

* CompanyController.php
* JobController.php
* RecruiterController.php

### Arquivos de Testes Unitários (talentify_api -> tests -> Feature)

* CompanyApiTest.php
* JobApiTest.php
* RecruiterApiTest.php
