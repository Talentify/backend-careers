---
##__backend-careers__

Criado para vaga de desenvolvedor

Felipe Gianelli Pena

Como eu já trabalhava com o symfony anteriormente, pode surgir algum pacote que eu 
não coloquei na instalação, caso aconteça por favor entre em contato  que rapidinho colocamos a
aplicação para funcionar.

(61) 99949-0091

#### Requisitos:
+ Composer
+ Symfony 5
+ PHP 7.4
  - driver mysql
  - driver pgsql (symfony requisita)
* mySQL 8.x ou bd de sua preferência, só precisa alterar as configurações.

####Instação no Ubuntu
+ Configuração
  - .env file DATABASE_URL= ..... ( colocar senha do db )
  - executar comandos no diretório raiz
 
    
    composer install
    
    bin/console doctrine:database:create
    bin/console doctrine:schema:update --force
    bin/console doctrine:fixtures:load --no-interaction
    
    symfony server:start
    
Depois de tudo é só iniciar o server e acessar em http://localhost:8000/
+ Login no sistema
  - usuario: admin
  - senha: admin


####Execução de testes
 
    
    Executar comando
    
    ./bin/phpunit
   
   