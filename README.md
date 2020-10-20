## Sobre o teste
O teste foi realizado no dia de hoje (19/10), fiz bem rapidinho para atender o básico do teste porque como comentei,
ainda tenho alguns projetos que finalizam hoje mesmo! Então preciso atender no prazo, até mesmo para me desligar
com tranquilidade.

Adicionei alguns itens como docker, logs no Elasticsearch com Kibana, e fiz o upload da aplicação no EC2 da AWS 
para testes.

## Build
Para iniciar a aplicação, basta fazer o clone do repositório, entrar na pasta *docker* e executar comando
````shell script
docker-compose up --build -d
````

Em seguida é necessário acessar a pasta raiz da aplicação e executar

````shell script
composer install
````

Executar as migrations (preferencialmente dentro do container)

````shell script
php artisan migrate
````

Criar as chaves do passport

````shell script
php artisan passport:install
````

As rotas de acesso a aplicação são:

> *POST* /api/jobs/ para criar uma nova vaga. O payload abaixo serve como exemplo de envio:

````json
{
    "job": {
        "title" : "PHP Senior developer",
        "description": "This is my description.",
        "workplace": "Avenue Vanilla PHP",
        "salary": "8500.78",
        "status": "opened"
    }
}
````

> *GET* /api/jobs/ para listar todas as vagas.
>
> *GET* /api/jobs/status/{status} para listar todas as vagas de acordo com o status.
>
> *DELETE* /api/jobs/{job_id} para remover uma vaga.
>
> *PUT* /api/jobs/{job_id} para atualizar os dados de uma vaga. O payload abaixo serve como exemplo de envio:
                                                               
````json
{
   "job": {
       "title" : "PHP Senior developer",
       "description": "This is my description.",
       "workplace": "Avenue Vanilla PHP",
       "salary": "8500.78",
       "status": "opened"
   }
}
````

## A empresa
A Talentify.io nasceu da fusão de 3 empresas distintas em 3 áreas diferentes: Digital Media & Advertising, Mobile Technology e HR Consulting. Nossa plataforma de SaaS ajuda empresas a superar seus maiores desafios na  busca e contratação de talentos em grande escala.

## A vaga
Estamos constante adicionando novas features e aperfeiçoando as já existentes. Como desenvolvedor sênior, voce será responsável por criar código limpo, testável, e de alta qualidade, além de auxiliar o restante da equipe a migrar código existente para a nova arquitetura orientada a domínio.Somos adeptos de desenvolvimento ágil, integração contínua, code review e testes automáticos. Com isso, nossa equipe busca constantemente desenvolver e aprimorar o produto para estarmos sempre a frente do mercado.

## Beneficios
- Home office (a ser combinado)
- Horario flexivel
- Assistencia medica e odontologica (apos 3 meses)
- Vale refeicao e transporte

## Requisitos
- PHP 7
- Desenvolvimento de testes
- Desenvolvimento Agil
- Web Services (RESTful ou SOAP ou JSON-RPC, etc)
- Algum dos frameworks PHP (Phalcon, Zend, Symfony, Laravel)
- Familiaridade com as PHP Standards Recommendations (PSRs)
- GIT
- Banco de dados relacional (MySQL, PostgreSQL, etc)

## Desejável
- Arquitetura hexagonal
- DDD
- Microserviços
- Filas de mensagens (RabbitMQ, Apache Kafka, Amazon SQS, etc)
- Elasticsearch
- Linux
- Amazon Web Services (AWS)
- CI/CD
- Inglês (leitura, escrita e conversação)

## Talk is cheap. Show me the code!
Você deverá construir um pequeno sistema para publicação de vagas de emprego. Ele irá possuir os seguintes recursos:
* Interface, de acesso público, com a listagem das vagas abertas
* Interface para login
* Interface administrativa, de acesso privado, com os seguintes recursos:
  * Cadastro de vaga contendo os campos: title (string, 256 characteres, obrigatório) , description (string, 10000 caracteres, obrigatório), status (enum, obrigatório), workplace (endereço, opcional), salary (dólar americano, opicional).
 
#### Observações
- Você pode, ou não, utilizar qualquer framework ou biblioteca PHP que desejar, desde que a lógica de negócio descrita acima seja feita por você, em puro PHP.
- As interfaces podem ou não serem gráficas (GUI), isto é, podem ser qualquer tipo de canal que possibilite a comunicação com a aplicação, tais como: RESTful, GraphQL, SOAP, JSON-RPC, (X)HTML com ou sem javascript, etc.
- Um README.md deverá ser adicionado e conter, no mínimo, as instruções de setup e utilização da aplicação.

#### Envio
Para enviar o seu código, submeta uma pull request para este repositório.

#### Disclaimer
O código fonte que você produzir será utilizado somente para avaliar sua aptidão para a vaga. Não será feito nenhum uso comercial do código fonte, tampouco haverá a exigência de direitos de atribuição.

