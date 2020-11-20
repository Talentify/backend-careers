
# Teste prático - Talentify

Este repositório tem como objetivo principal a demonstração de conhecimento prático quanto as tecnologias requisitadas para admissão da vaga Desenvolvedor Sênior

# O projeto

Consiste em um sistema de vagas, onde terá um acesso administrativo para gerência dos registros e uma tela inicial para listagem das vagas disponíveis

## Especificações técnicas
- PHP 7.3
- Laravel 8
- MySQL 5.7

## Requisitos técnicos
- Docker
- Portas 9000 e 9001 disponíveis. Caso estejam em uso, alterar o arquivo **docker-compose.yml**

## Instalação
### Windows
Abrir o terminal de comando, acessar a pasta do projeto e rodar o seguinte comando:
```bash
init.bat
```
### Mac/Linux
Abrir o terminal de comando, acessar a pasta do projeto e rodar o seguinte comando:
```bash
bash init.sh
```
Após a execução do passo acima, basta clicar no link ao lado: [Acessar aplicação](http://localhost:9000 "Acessar aplicação diretamente") ou digitar na barra de navegação: http://localhost:9000.
##### OBS: caso tenha alterado a porta no 'docker-compose.yml', a porta de acesso à aplicação também irá mudar.

## Utilização
Há, na raiz do projeto, um arquivo **insomnia.json**, que pode ser importado no Insomnia. Nele contém todas as chamadas aos endpoints da aplicação, já com payload.
Para realizar as requisições do 'Admin', é necessário realizar a chamada ao ednpoint 'Login' e pegar o token gerado e colocar no Header das requisições, conforme abaixo:
**Authorization: Bearer COLAR_TOKEN_AQUI**

## Execução dos testes
Abrir o terminal de comando, acessar a raiz do projeto e executar o comando de acordo com o seu respectivo sistema operacional:
### Windows
```bash
tests.bat
```
### Mac/Linux
```bash
bash tests.sh
```