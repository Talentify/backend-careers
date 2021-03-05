## Introdução

### Tecnologias utilizadas e pré-requisitos

- PHP 8.0
- Laravel 8.12.*
- Composer 2.0.11
- MySQL 8.0

### Considerações técnicas

- Container/Docker: Idealmente, o projeto está preparado para rodar dentro de containers Docker/K8s, permitindo o
  escalonamento horizontal e vertical
- Sistema de token fixo: Atualmente, o token de autenticação é fixo, facilitando a forma de lidar com SPA e aplicativos
  mobile, mas nada impede de trabalhar com tokens com expiração definida de forma fácil com o Laravel Sanctum
- Por questão de simplicidade o arquivo .env está incluso no repositório, mas com um alerta que essa não é uma boa 
prática a se fazer em ambientes de produção

### Instalação e configuração

Com os pré-requisitos instalador, basta seguir os seguintes passos para ter a aplicação funcionando

- Após baixar o repositório, instale as dependências do projeto: `composer install`
- Agora, certifique-se de que o arquivo .env tem as credenciais corretas de banco de dados para que possamos executar as
  migrações de tabelas: `php artisan migrate`

Pronto! Com esses dois passos sua aplicação está funcional. Para utilizar o servidor web imbutido no Laravel basta
apenas executar: `php artisan serve`

### Endpoints

#### POST /api/recruiters
Endpoint para o cadastro de novos recrutadores

| Parâmetro | Descrição |
| --- | --- |
| name | (Obrigatório) Nome do recurtador |
| email | (Obrigatório) E-mail do recurtador |
| password | (Obrigatório) Senha do recrutador |
| company | (Obrigatório) Nome da empresa do recrutador. Caso a empresa já exista, ele será registrado na empresa, caso não, uma nova empresa será criada e ele será registrado na mesma |

### POST /api/recruiters/login
Endpoint para login dos recrutadores. O retorno será o token necessário para a autenticação Bearer nos endpoints

| Parâmetro | Descrição |
| --- | --- |
| email | (Obrigatório) E-mail do recurtador |
| password | (Obrigatório) Senha do recrutador |

### POST /api/jobs (autenticação necessária)
Endpoint para criação de vagas. O retorno será um objeto contendo as informações da vaga criada

| Parâmetro | Descrição |
| --- | --- |
| title | (Obrigatório) Título da vaga |
| description | (Obrigatório) Descrição da vaga |
| status | (Obrigatório) Status da vaga: active, inactive, pause, finished |
| address | (Obrigatório) Endereço da vaga |
| salary | (Obrigatório) Salário da vaga em formato float |

### POST /api/jobs/{jobId} (autenticação necessária)
Endpoint para alteração dos dados da vaga. O retorno será um objeto contendo as informações da vaga criada

| Parâmetro | Descrição |
| --- | --- |
| title | (Opcional) Título da vaga |
| description | (Opcional) Descrição da vaga |
| status | (Opcional) Status da vaga: active, inactive, paused, finished |
| address | (Opcional) Endereço da vaga |
| salary | (Opcional) Salário da vaga em formato float |

### POST /api/jobs/search
Endpoint para listagem de vagas públicas e busca por parâmetros definidos. O retorno será um array contendo objetos das vagas cadastrados no sistema

| Parâmetro | Descrição |
| --- | --- |
| company_id | (Opcional) Id da empresa para filtrar  |
| keywords | (Opcional) Palavras para sem buscadas tanto no título quanto na descrição da vaga, separados por vírgula. Exemplo: php,mysql,laravel |
| address | (Opcional) Endereço da vaga |
| salary | (Opcional) Salário da vaga em formato float |

## Testes
Para executar a bateria de testes basta apenas executar o seguinte comando na raiz do projeto: `php vendor/bin/phpunit`
