## Arquitetura
- Postgres
- Redis em H.A.
- Sonic (Motor de busca)
- Traefik (Proxy Reverso)


Cache: Eu entendi que s endpoins que mais seriam consultados seriam

## Como rodar o projeto

É importante informar que o projeto foi montado da maneira mais didatica possivel. eu não
aplicaria algumas coisas em produção, fiz para que fosse facil de executar em qualquer maquina,
o projeto necessita apenas do composer, php 7.4+ e docker, tudo que ele precisa para funcionar está nele mesmo,
basta rodar os sequintes comandos.

 - composer install (se tudo der certo será criado um arquivo .env)
 - docker-compose build
 - edite o arquivo .env, procure o IP 192.168.0.5 e substitua pelo seu ip na rede
 - docker-compose up (passe -d para rodar e Detached mode)
