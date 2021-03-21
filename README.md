## A vaga
Estamos constante adicionando novas features e aperfeiçoando as já existentes. Como desenvolvedor sênior, voce será responsável por criar código limpo, testável, e de alta qualidade, além de auxiliar o restante da equipe a migrar código existente para a nova arquitetura orientada a domínio.Somos adeptos de desenvolvimento ágil, integração contínua, code review e testes automáticos. Com isso, nossa equipe busca constantemente desenvolver e aprimorar o produto para estarmos sempre a frente do mercado.

<details>
<summary>Detalhes da vaga</summary>

## A empresa
A Talentify.io nasceu da fusão de 3 empresas distintas em 3 áreas diferentes: Digital Media & Advertising, Mobile Technology e HR Consulting. Nossa plataforma de SaaS ajuda empresas a superar seus maiores desafios na  busca e contratação de talentos em grande escala.

## Beneficios
- Home office (você pode trabalhar em casa ou em nosso escritório, em Alphaville/SP)
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

</details>

## Talk is cheap. Show me the code!

Você deverá construir uma API REST com as seguintes funcionalidades:
* Cadastro/Login de recrutadores, onde cada recrutador pertence a uma empresa diferente
* CRUD de vagas pelos recrutadores
   * Vagas possuem os campos: title, description, status, address, salary, company
   * Um recrutador não pode modificar vagas criadas por outro
* Listagem pública de vagas abertas
* Busca pública de vagas abertas
   * Critérios de busca que devem ser aceitos: keyword, address, salary, company
  
 
#### Observações
- É permitido utilizar qualquer biblioteca ou framework PHP, desde que a lógica de neǵocio seja escrita por você em PHP;
- Interface gráfica é opcional, desde que a comunicação com o back-end seja feita através dos endpoints REST desenvolvidos por você;
- Testes automatizados (de unidade e/ou funcionais e/ou aceitação) são **obrigatórios**;
- Um README.md deverá ser adicionado e conter, no mínimo, as instruções de setup e utilização da aplicação.

#### Envio
Para enviar o seu código, submeta uma pull request para este repositório com o título da PR contendo seu nome e sobrenome.

#### Disclaimer
O código fonte que você produzir será utilizado somente para avaliar sua aptidão para a vaga. Não será feito nenhum uso comercial do código fonte, tampouco haverá a exigência de direitos de atribuição.





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Sobre a Aplicação
Essa aplicação foi desenvolvida em Laravel para o meu processo seletivo da Talentify. Claro que está funcional, porém precisa de vários refinamentos. Todos os requisitos solicitados, acredito que foram atendidos.<br/>
Para api é usado Guzzle que já vem como parte do Framework Laravel a partir da versão 7.

## Instrução para utilização da aplicação
Todas as aqui repassas devem ser realizadas após o clone do projeto.</br>
<b>Base Mysql:</b> talentify

Seguir os passos abaixo:<br/>
- composer install<br/>
- composer global require laravel/installer<br/>
- composer dumpautoload<br/>
- php artisan key:generate<br/>
- php artisan migrate --seed<br/>
-- User: admin@admin.com.br<br/>
  -- Pass: 12345678

##Endpoints e Rotas
</br>
<a href="https://ibb.co/QrJsy4S"><img src="https://i.ibb.co/cDyz4jf/Rotas.png" alt="Rotas" border="0"></a>
