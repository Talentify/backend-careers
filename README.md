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

###Result
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

#Login
{host}/api/auth
```
{
    "username" : "christian",
    "password" : "123456"
}
```

###Result
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
#ME
{host}/api/me
```
{
    "token" : "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6OTA5MFwvYXBpXC9hdXRoIiwiaWF0IjoxNjE4MDcxNjEyLCJleHAiOjE2MTgwNzUyMTIsIm5iZiI6MTYxODA3MTYxMiwianRpIjoiVWJrSnhiZXFIbFJpNHJsMSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.h0vnxgiu68BDLVD0agNLxXD1cNtDxxg3Dc9jqOxQSQ0"
}
```

###Result
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
