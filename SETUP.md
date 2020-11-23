# Instruções

## Versões
O projeto foi desenvolvido considerando as seguintes versões:

- docker: 19.03.13
- docker-compose: 1.25.0

## Docker
Para subir os containers, execute:

```docker-compose up -d```

## Instalação de dependência e setup
Instale os pacotes do composer:

```docker exec -it talentify-php composer install```

A seguir, execute o setup:

```docker exec -it talentify-php composer setup```

O script de setup será responsável por criar um par de chaves para geração de JWT, executar o migrate e carregar o seed com usuário de teste

Após setup, acesse o arquivo .env.local e altere o atributo JWT_PASSPHRASE para a senha que foi especificada na geração da chave.

## Testes
Para executar os testes de API:

```docker exec -it talentify-php composer test```

Para visualizar as vagas inseridas pela rotina de testes:

```curl http://localhost:9000/v1/jobs-active```

## Token
Para gerar JWT e utiliza-lo na geração de vaga:

```curl -X POST -H "Content-Type: application/json" http://localhost:9000/v1/login -d '{"username":"test","password":"test"}'```

Será retornado um documento json com atributo token. O token deve ser utilizado como header da requisição para registrar uma Vaga. Por exemplo:

```curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer {JWT}" http://localhost:9000/v1/jobs -d '{"title": "Teste curl", "description":"Vaga de teste", "status": "active"}'```

Altere a marcação {JWT} pelo token retornado no endpoint de login

## Documentação
A documentação da API está disponível na pasta docs/ do projeto ou através do link temporário do petstore do swagger:

https://petstore.swagger.io/?url=https://gist.githubusercontent.com/vinaocruz/b9aab93077e67aadcaff03a497a7f845/raw/job-api.yml

## Suporte
Qualquer dúvida, pode entrar em contato pelo e-mail vinaocruz@gmail.com ou no Telegram em @vinaocruz