<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sobre a aplicação

Trata-se de um pequeno sistema de publicação de vagas, onde é possível visualizar e também fazer o cadastro de novas vagas:

## Configurando
- Execute os comandos abaixo
   - composer install
   - php artisan key:generate
   - cp .env.example .env (crie uma cópia do arquivo .env.example que está na raiz deixando apenas .env)
   - Abra o .env e configure a conexão com o banco de dados:
      - DB_CONNECTION=mysql
      - DB_HOST=127.0.0.1
      - DB_PORT=3306
      - DB_DATABASE=nome_do_banco
      - DB_USERNAME=usuario
      - DB_PASSWORD=senha
   - php artisan migrate:fresh --seed
   - php artisan serve

## Acesso
- localhost:8000
- Usuário : admin@admin / Senha: admin
