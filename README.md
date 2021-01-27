## Descrição
O projeto foi construído usando Laravel, mas utilizando pouquíssimo de seus recursos para
priorizar o PHP puro no desenvolvimento das regras de negócio. O frontend foi feito com HTML,
CSS e JS puros utilizando apenas bootstrap, mas não é o foco do projeto, foi feito apenas para
interação com o sistema.

## Setup
- O projeto foi desenvolvido na versão 7.4.7 do PHP.
- Necessário criar um banco de dados local (MySQL) chamado `talentify`.
- Para inicializar os módulos requeridos, executar `composer update`.
- Para criar a estrutura do banco de dados, executar `php artisan migrate`.
- Para criar algumas vagas de teste e um usuário administrador, executar `php artisan db:seed`.
- O login administrador para acesso é: `admin@gmail.com - 123456`.
- Para executar os testes unitários, executar `./vendor/bin/phpunit`.
- Após a finalização de todos os passos, para rodar o projeto, executar `php artisan serve` e
acessar `127.0.0.1:8000`.