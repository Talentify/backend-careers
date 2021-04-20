<h4 align="center">
  🚀 Before Soccer - API Resful para Futebol de Salão - Teste técnico
</h4>

<p align="center">
 <img src="https://img.shields.io/static/v1?label=PRs&message=welcome&color=7159c1&labelColor=000000" alt="PRs welcome!" />

  <img alt="License" src="https://img.shields.io/static/v1?label=license&message=MIT&color=7159c1&labelColor=000000">
</p>

<p align="center">
  <a href="#rocket-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-funcionalidades">Funcionalidades</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-requisitos">Requisitos</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-instalação">Instalação</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
</p>

<br>

## :rocket: Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP 7.2](https://php.net)
- [Laravel 7](https://laravel.com)
- [MySQL 5.7](https://mysql.com)
- [Docker](https://docker.com)


## 💻 Projeto

Esse projeto é uma API Restful desenvolvida como teste técnico para o processo seletivo de Desenvolvedor Backend na Before TI.


## 💻 Funcionalidades

O sistema possui cadastros/listagem/exibição/alteração de jogadores, times, partidas, cartões e gols assim como autenticação em JWT e ranking de times e jogadores. A infraestrutura é toda configurada pelo docker/docker-compose.

## 📄 Requisitos

* PHP 7.2+, Laravel 7+, MySQL 5.7+ e Docker


## ⚙️ Instalação e execução

**Windows, OS X & Linux:**

Baixe o arquivo zip e o descompacte ou baixe o projeto para sua máquina através do git clone [https://github.com/randercarlos/before-soccer.git](https://github.com/randercarlos/before-soccer.git)


- Entre no prompt de comando e vá até a pasta do projeto:

```sh
cd ir-ate-a-pasta-do-projeto
```

- Crie o arquivo .env a partir do arquivo .env.example. As variáveis de ambiente relacionadas ao banco já estão configuradas.

```sh
copy .env.example .env
```

- Assumindo que tenha o docker instalado na máquina, para subir os containeres, execute o comando:

```sh
docker-compose up
```

- Após isso, execute o comando abaixo para instalar as dependências do laravel.

```sh
docker-compose exec before-soccer-app composer install
```
- Aguarde até que todas as dependências do laravel estejam instaladas. Após isso, rode o comando abaixo para instalar as migrações e os seeds:

```sh
docker-compose exec before-soccer-app php artisan migrate --seed
``` 

- Após rodar o comando acima, o sistema já estará pronto e acessível em [http://localhost:8000](http://localhost:8000).  

- Para rodar e testar os endpoints, use a coleção de endpoints exportados do Insomnia que se encontra logo abaixo

## 📝 Documentação

- [Insomnia Endpoints Collection](before-soccer-endpoints-insomnia.json) (Para importar, clique no menu "Application" => Preferences => Data => Clique em "Import Data" => "From File" => selecione o arquivo e clique em "Import")

Desenvolvido por Rander Carlos :wave: [Linkedin!](https://www.linkedin.com/in/rander-carlos-caetano-freitas-308a63a8/)
