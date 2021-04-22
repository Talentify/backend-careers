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

OBs.: Para acessar a API não esquecer de acionar o seguinte comando 

```
php artisan serve
```

Para acessar os endpoints protegidos, é importante antes fazer o login
e será retornado o token para acesso ao sistema. 
Se você acionou o comando para popular o banco de dados com alguns registros, é possível também usar os seguintes dados
para login e senha na api:

```
POST http://localhost:8000/api/login
form-data:
  login: admin
  password: talentify1
```

Depois basta adicionar o token na seção Authorization -> Bearer Token do Postman por exemplo
para poder testar as requisições que exigem autorização.


#### EndPoints PUBLICOS

* Recruiter

Efetuar Login
```
POST http://localhost:8000/api/login
form-data:
  login: ???
  password: ???
```

* Job

Obter todas as vagas:
```
GET http://localhost:8000/api/jobs
```

Obter todas as vagas abertas:
```
GET http://localhost:8000/api/openjobs
```

Ver uma vaga específica:
```
GET http://localhost:8000/api/jobs/{#id}
```  

Filtrar as vagas por keyword, address, salary, company:
```
POST http://localhost:8000/api/jobsfilter
form-data:
  keyword: ???
  address: ???
  salary: ???
  company: ???
```


#### EndPoints PROTEGIDOS

* Recruiter

Registrar novo usuário (Recrutador):
```
POST http://localhost:8000/api/register
form-data:
  id_company: #1
  name: ???
  login: ???
  password: ???
```

Deslogar da API:
```
POST http://localhost:8000/api/logout
```

* Company

Obter todas as empresas:
```
GET http://localhost:8000/api/companies
```

Ver uma empresa específica:
```
GET http://localhost:8000/api/companies/{#id}
```

Cadastrar uma empresa:
```
POST http://localhost:8000/api/companies
form-data:
  name: ???
```

*  Job

Cadastrar uma nova vaga:
```
POST http://localhost:8000/api/jobs
form-data:
  'title': ???
  'description': ???
  'address': ???
  'salary': ???
  'company': ???
```

Atualizar uma vaga:
```
PUT http://localhost:8000/api/jobs/{#id}
form-data:
  'title': ???
  'description': ???
  'address': ???
  'salary': ???
  'company': ???
```

Remover uma vaga:
```
DELETE http://localhost:8000/api/jobs/{#id}
```


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
