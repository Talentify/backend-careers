# TALENTIFY_API

Implementação de uma API REST utilizando o framework LARAVEL

## Começando

Essas instruções fornecerão uma cópia do projeto em funcionamento em sua máquina local para fins de desenvolvimento e teste. Leia o conteúdo a seguir para fazer a instalação e permitir o funcionamento da aplicação

### Pré-requisitos

Primeiramente você precisa ter o composer instalado em sua máquina: [https://getcomposer.org/download/](https://getcomposer.org/download/)

Com o composer já instalado, faça o download do repositório: 

```
git clone https://github.com/eidercarlos/backend-careers.git
```

Em seguida, dentro do diretório backend-careers faça um chekout no branch eider_carlos

```
git checkout eider_carlos
```

### Instalando

Tenha já a instalação do Laravel em sua máquina:

```
  composer global require laravel/installer
```

Entre na pasta talentify_api e faça a instalação/atualização das dependências:

```
composer update
```

Em seguida, dentro da mesma pasta talentify_api, a partir do arquivo .env.example crie um novo arquivo com o nome .env e defina as configurações locais 
do seu banco de dados MySQL

``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=talentify_api_db
DB_USERNAME=root
DB_PASSWORD=
```

Não esqueça de também gerar uma KEY para a sua aplicação

```
php artisan key:generate
```



Termine com um exemplo de tirar alguns dados do sistema ou usá-lo para um pequeno demo

## Executando os testes

Explique como executar os testes automatizados para este sistema

### Divulgue em testes de ponta a ponta

Explique o que esses testes testam e por que

```
  Dê um exemplo
```

### E testes de estilo de codificação

Explique o que esses testes testam e por que

```
  Dê um exemplo
```

## Desdobramento, desenvolvimento

Adicione notas adicionais sobre como implantar isso em um sistema ao vivo

## Built With

* [Nome](#site) - Usada para algo...

## Contribuindo

Leia [CONTRIBUTING.md](https://gist.github.com/hi-hi-ray/a868081e2a63ee47fafa015353d05ae3) para obter detalhes sobre nosso código de conduta e o processo para enviar pedidos de extração para nós.

## Versioning

Usamos [SemVer](http://semver.org/) para versões. Para as versões disponíveis, veja [tags neste repositório](https://github.com/your/project/tags).

## Autores

* ** Billie Thompson ** - * Trabalho inicial * - [PurpleBooth](https://github.com/PurpleBooth)
* ** Raysa Dutra ** - * Tradução Pt-Br * - [hi-hi-ray](https://github.com/hi-hi-ray)

Veja também a lista de [contribuidores](https://github.com/your/project/contributors) que participaram deste projeto.

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para obter detalhes

## Agradecimentos

* Dica de um pessoa
* Inspiração
* Etc.

-----------------------------------------------

# Project Title

One Paragraph of project description goes here

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
Give examples
```

### Installing

A step by step series of examples that tell you have to get a development env running

Say what the step will be

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc
