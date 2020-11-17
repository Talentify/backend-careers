Link para acesso à coleção do postman da aPI
<br/>
https://documenter.getpostman.com/view/7967135/TVeqc6ud

## Observações
Como é apenas um teste boa parte das coisas que eu fiz não faria em produção, tem muito a melhorar


## Arquitetura
- Postgres
- Redis em H.A.
- Sonic (Motor de busca)
- Traefik (Proxy Reverso)

<br/>
Search Engine: Eu escolhi o Sonic por ser mais leve e facil, porem daria para usar elastisearch
<br/><br/>
Cache: Eu entendi que os endpoins que mais seriam consultados seriam os de listagem de vagas,
assim eu coloquei um cache que salva todas as respostas com status code 200 em cache,
assim quando a requisição for feita novamente o sistema não precisará acessar o banco de dados
<br/><br/>
DDD: O DDD é bem amplo e ainda não tenho total expertise nele, por isso implementei apenas alguns conceitos.
<br/><br/>
DTOs: Fiz um exemplo simples, mais poderiam havar DTOs para cada tipo de operação do CRUD
<br/><br/>
Testes: Eu não tenho conhecimento pratico sobre testes, por isso optei por não implementar.
<br/><br/>
Abstrações: Boa parte delas não eram necessárias, eu só fiz para que possam avaliar minhas skills.
<br/><br/>

## Como rodar o projeto

É importante informar que o projeto foi montado da maneira mais didatica possivel. eu não
aplicaria algumas coisas em produção, fiz para que fosse facil de executar em qualquer maquina,
o projeto necessita apenas do composer, php 7.4+ e docker, tudo que ele precisa para funcionar está nele mesmo,
basta rodar os sequintes comandos.

 - composer install (se tudo der certo será criado um arquivo .env)
 - edite o arquivo .env, procure o IP 192.168.0.5 e substitua pelo seu ip na rede
 - php artisan migrate
 - docker-compose build
 - docker-compose up (passe -d para rodar e Detached mode)

basta acessar apache.localhost que você ja estará acessando a aplicação (Usar coleção do postman do inicio da pagina).

Há 3 dominios que podem ser acessados.
<br/>
- apache.localhost (Aplicação) <br/>
- traefik.localhost (Dashboard do Traefik)<br/>
- commander.localhost (Gerenciador do Redis)<br/>


<br/>
Notas:

Dê uma olhada no Core Domain, acho que tem muita coisa legal lá
