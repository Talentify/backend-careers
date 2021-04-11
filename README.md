## Executar a aplicação

- Clonar o repositório
- executar o comando composer install
- copiar o arquivo .env.example para .env, definir as configuração de banco
- executar o comando php artisan optimize, para regarrar as informações
- executar o comando php artisan migrate (irá crias tabelas, para que o sistema funcione corretamente)
- Aplicação executando com Laravel 8 e php 7.4
- Pode o sistema pode ser executado tanto local ou hospededado em algun servidor web, desde que tenha todos os protocolos HTTP GET, POST, PUT e DELETE habilitados.
- Dentro do repositório temos dois arquivos que pode ser usados(importados) nos clientes REST (Postman ou Insomnia).
- Após ser feito o registro, o sistema automaticamente irá fazer o login do usuário, gerando um token. Esse token deve ser copiado e alterado nos headers das seguintes rotas "Create Vacancies", "List Vancancies By User", "Update Vancancies", "Delete Vancancies".
- A opção no header que deve ser alterada é o valor da propriedade "Authorization", seu value deve ser assim "Bearer {token que foi copiado/gerado}", sem as apas.

# Registro
{host}/api/register
```
    header Content-Type multipart/form-data
```
#### Payload
```
{
	"name" : "Christisan",
	"email" : "chkilian89@gmail.com",
	"username" : "christian",
	"password" : "123456",
	"company" : {
		"name" : "Vargas LTDA"
	}
}
```

### Result
```
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6OTA5MFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTYxODA4ODQ2NywiZXhwIjoxNjE4MDkyMDY3LCJuYmYiOjE2MTgwODg0NjcsImp0aSI6InhqOWhVRlBWS29oVTFTdlQiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.qOpqmid9sqv03CQXIeYWlIzxwggKpeVcSM5YwfTnBcc",
  "user": {
    "id": 1,
    "name": "Christisan",
    "email": "chkilian89@gmail.com",
    "username": "christian",
    "email_verified_at": null,
    "company_id": 1,
    "created_at": "2021-04-10T21:01:06.000000Z",
    "updated_at": "2021-04-10T21:01:06.000000Z"
  }
}
```

# Login
{host}/api/auth
```
    header 
        Content-Type multipart/form-data
```
#### Payload
```
{
    "username" : "christian",
    "password" : "123456"
}
```

### Result
```
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6OTA5MFwvYXBpXC9hdXRoIiwiaWF0IjoxNjE4MDkyMDgwLCJleHAiOjE2MTgwOTU2ODAsIm5iZiI6MTYxODA5MjA4MCwianRpIjoiTVBUT29kSHpvam5oMUEwZyIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.7drRirHE3_QytoC6qS10tvytzlysfR1Rv9AZSNCLmOM",
  "user": {
    "id": 1,
    "name": "Christisan",
    "email": "chkilian89@gmail.com",
    "username": "christian",
    "email_verified_at": null,
    "company_id": 1,
    "created_at": "2021-04-10T21:01:06.000000Z",
    "updated_at": "2021-04-10T21:01:06.000000Z"
  }
}
```
# ME
{host}/api/me
```
    header 
        Content-Type multipart/form-data
        Authorization Bearer {token}
```
#### Payload
```
{
    "token" : "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6OTA5MFwvYXBpXC9hdXRoIiwiaWF0IjoxNjE4MDcxNjEyLCJleHAiOjE2MTgwNzUyMTIsIm5iZiI6MTYxODA3MTYxMiwianRpIjoiVWJrSnhiZXFIbFJpNHJsMSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.h0vnxgiu68BDLVD0agNLxXD1cNtDxxg3Dc9jqOxQSQ0"
}
```

### Result
```
{
  "user": {
    "id": 1,
    "name": "Christian",
    "email": "chkilian89@gmail.com",
    "username": "christian",
    "email_verified_at": null,
    "company_id": 1,
    "created_at": "2021-04-10T16:18:38.000000Z",
    "updated_at": "2021-04-10T16:18:38.000000Z"
  }
}
```
# Resfresh Token
```
    header 
        Content-Type multipart/form-data
        Authorization Bearer {token}
```
### Result
```
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6OTA5MFwvYXBpXC9hdXRoLXJlZnJlc2giLCJpYXQiOjE2MTgxNDc0MDksImV4cCI6MTYxODE1MTAyNywibmJmIjoxNjE4MTQ3NDI3LCJqdGkiOiI3d29qNmNMOGZQSzdMOHl2Iiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.KFv1x__UiM-8iJP-q3iA6Ia7kGOQcaeNC0llHFk0DQs"
}

```

# Create Vacancies
```
    header 
        X-Requested-With XMLHttpRequest
        Content-Type application/json
        Authorization Bearer {token}
```
#### Payload
```
{
	"title" : "Desenvolvedor JAVA ",
	"status" : "Em Aberto",
	"address" : "Rua Um A, 600 - Rio Santo/SP",
	"salary" : 5000,
	"keyword" : "JAVA, Desenvolvedor"
}
```

### Result

```
{
  "title": "Desenvolvedor JAVA",
  "status": "Em Aberto",
  "address": "Rua Um A, 600 - Rio Santo\/SP",
  "salary": 5000,
  "keyword": "JAVA, Desenvolvedor",
  "user_id": 1,
  "company_id": 1,
  "updated_at": "2021-04-10T22:01:31.000000Z",
  "created_at": "2021-04-10T22:01:31.000000Z",
  "id": 2
}
```
# List Vacancies by User (irá retornar todas as vagas cadatradas pelo usuário logado)
```
    header 
        X-Requested-With XMLHttpRequest
        Content-Type application/json
        Authorization Bearer {token}
```
### Result
```
[
  {
    "id": 1,
    "title": "ATUALIZADOOO",
    "status": "Em Aberto",
    "address": "Rua Um A, 600 - Rio Claro\/SP",
    "salary": 1500,
    "user_id": 1,
    "company_id": 1,
    "created_at": "2021-04-10T17:30:00.000000Z",
    "updated_at": "2021-04-10T20:28:14.000000Z",
    "deleted_at": null
  },
  {
    "id": 2,
    "title": "TESTE AA",
    "status": "Em Aberto",
    "address": "Rua Um A, 600 - Rio Claro\/SP",
    "salary": 1500,
    "user_id": 1,
    "company_id": 1,
    "created_at": "2021-04-10T19:39:20.000000Z",
    "updated_at": "2021-04-10T19:39:20.000000Z",
    "deleted_at": null
  }
]
```
# Update Vacancies
{host}/api/v1/vacancies/create/{id}
```
    header 
        X-Requested-With XMLHttpRequest
        Content-Type application/json
        Authorization Bearer {token}
```
#### Payload
```
{
  "title": "Desenvolvedor JAVA",
  "status": "Em Aberto",
  "address": "Rua Um A, 600 - Rio Claro\/SP",
  "salary": 5000,
  "keyword": "JAVA, Desenvolvedor"
}
```
### Result
```
{
  "id": 2,
  "title": "Desenvolvedor JAVA",
  "status": "Em Aberto",
  "address": "Rua Um A, 600 - Rio Claro\/SP",
  "salary": 5000,
  "keyword": "JAVA, Desenvolvedor",
  "user_id": 1,
  "company_id": 1,
  "created_at": "2021-04-10T22:01:31.000000Z",
  "updated_at": "2021-04-10T22:02:59.000000Z",
  "deleted_at": null
}
```

# Delete Vacancies
```
    header 
        X-Requested-With XMLHttpRequest
        Content-Type application/json
        Authorization Bearer {token}
```
{host}/api/v1/vacancies/destroy/{id}

##### Obs: por default são retornados 10 registros por páginas, mas para ir para proxima pagina basta adicionar esse paramentro "?page=numero" no final da url
# List Public Vacancies
{host}/api/list-vacancies

```
    header 
        Content-Type application/json
```
### Paylod (filter é opcional, mas passando o filter o sistema irá fazer a buscar e retornar o que usuário está buscando.)

```
{
    "filter" : "keyword, address, salary, company"
}

```

### Result
```
{
  "current_page": 1,
  "data": [
    {
      "title": "Desenvolvedor PHP com Laravel ou qualquer outro framework",
      "status": "Em Aberto",
      "address": "Rua Um A, 600 - Rio Santo\/SP",
      "salary": 5000,
      "keyword": "PHP, Laravel, Desenvolvedor",
      "company": "Vargas LTDA"
    }
  ],
  "first_page_url": "http:\/\/localhost:9090\/api\/list-vacancies?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http:\/\/localhost:9090\/api\/list-vacancies?page=1",
  "next_page_url": null,
  "path": "http:\/\/localhost:9090\/api\/list-vacancies",
  "per_page": 10,
  "prev_page_url": null,
  "to": 1,
  "total": 1
}
```
