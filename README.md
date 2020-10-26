# ApiRouter-Jobs

[![Maintainer](http://img.shields.io/badge/maintainer-@thalesrupp-blue.svg?style=flat-square)](https://twitter.com/thalesrupp)

###### 
## About ApiRouter
Simples e Pequeno, ApiRouter-Jobs + Firebase
###### 

### Highlights

- Utilizado um Router para Gerenciar as rotas (coffeecode/router)
- Implentado Abstração Com banco de Dados Firebase, utilizando como base (kreait/firebase-php),
  Optei Pelo Firebase, pelo fato de ter poucos projetos em Php que utilizam ele, tornando o teste mais evolutivo como desenvolvedor
- Desenvolvido e implementado gerador e validção de requisições através de JWT, sem libs de terceiros que autentica o usuário usando os dados presentes
  no presentes Firebase
- Desenvolvido e Implementado Validação de dados em cada etapa do CRUD, respeitando as regras de cada elemento como tipo, tamanho maximo de caracteres, string etc... 
- Este Projeto conta com a opção de "Dropar" tabelas, tornando os testes mais dinamicos
- Aplicação Funcional através de consumos pelas rotas definidas

## Installation


## Documentation

###### 
```apacheconfig
RewriteEngine On
#Options All -Indexes

RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
# ROUTER URL Rewrite
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteRule ^(.*)$ index.php?route=/$1
```

##### Routes Public

Exemplo da Api em funcionamento:  http://webserver666.online/apiRouter/api/public/allJobs

URL: 
/api/public/allJobs
<p>
Método:
GET <p>
Rota Publica que retornar Todas as vagas Disponiveis <p>
Retornos Possíveis: <p>

```apacheconfig
200 OK
{
    allRecords: [
            {
                description: "FullStack Developer JS",
                id: 1,
                salary: "6200",
                status: "pub",
                title: "Vaga Dev FullStack PHP",
                workplace: ""
             },
             {
                description: "Back-End Developer",
                id: 2,
                salary: "5400",
                status: "psd",
                title: "Vaga Dev FullStack JS",
                workplace: ""
             },
             {
                description: "FullStack PHP",
                id: 3,
                salary: "7980",
                status: "pub",
                title: "Vaga Dev FullStack Web",
                workplace: ""
            }
    ]
}
```
#### Routes Admin Login

URL: 
/api/admin/login
<p>
Método:
POST <p>
Rota para Autenticar Usuário<p>

Se existir o usuário retorna um jwt<p>
Obs: jtw_token gerado possui expiração de 60minutos, após expirar é exibido o erro de Token Inválido<p>
header-name: content-type  Header-value: application/x-www-form-urlencoded 
Body-content-type: application/x-www-form-urlencoded 

Realizar Login Novamente para gerar um token vaálido
```apacheconfig
200 OK
{
   jtw_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDM3MTg5MDIsIm5hbWUiOiJUaGFsZXMgUnVwcGVudGhhbCIsImVtYWlsIjoidGhhbGVzLnJ1cEBnbWFpbC5jb20ifQ.1WMiPtHslQtT55bOOiHDpxtkgiZB8cYV5Ad7h749wjc"
}
```

Token Expirado
```apacheconfig
200 OK
{
    status: "error",
    msg: "Token Inválido"
}
```
Tabela definida para Login em AuthController não existir
```apacheconfig
200 OK
{
    msg: "Tabela users Informada Não Localizada",
    status: "error"
}
```
#### Routes Admin Jobs

URL: 
/api/admin/createJob
<p>
Método:
POST <p>
Rota para Criar Vagas<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno se Barrado pelo FormValidade, valida tipagem e parametros adicionais como maxlength em string e enum's em valores
```apacheconfig
200 OK
{
    0: {
        Elemento Obrigatório: [
          title,
          description,
          status
        ],
    },
    "status": "error"
}
```

Retorno Inserir success
```apacheconfig
200 OK
{
    status: "success",
    dataInsert: {
        description: "Será Responsável pela manutenção fisica que o empregador designar",
        id: 4,
        salary: "1950",
        status: "pub",
        titl: "Faxineiro",
        workplace: "Rua João Maria da Fonseca 116 São José Canoas"
    }
}
```
URL: 
/api/admin/updateJob
<p>
Método:
POST <p>
Rota para Atualizar Vagas<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno Id não localizado 
```apacheconfig
200 OK
{
    msg: "Informe Um id válido",
    status: "error"
}
```
Retorno Update success<p>
Obs: Usado o ultimo registro inserido, alterado status de pub = publicado para psd = pausado
```apacheconfig
200 OK
{
    status: "success",
    dataUpdate: {
        description: "Será Responsável pela manutenção fisica que o empregador designar",
        id: 4,
        salary: "1950",
        status: "psd",
        title: "Faxineiro",
        workplace: "Rua João Maria da Fonseca 116 São José Canoas"
    }
}
```
URL: 
/api/admin/deleteJob
<p>
Método:
POST <p>
Rota para Deletar Vagas<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno Id não localizado 
```apacheconfig
200 OK
{
    msg: "Informe Um id válido",
    status: "error"
}
```
Retorno Delete success 
```apacheconfig
200 OK
{
    status: "success",
    dataDelete: true
}
```

#### Routes Admin Users

URL: 
/api/admin/createUser
<p>
Método:
POST <p>
Rota para Criar Usuários<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Parametros Necessários:<p>
Obs: Email possui validação de caracteres e password é encriptado antes de salvar no banco

```apacheconfig
{
    email: string|email,
    name: string,
    password: string,
    permission: 1 = admin, 3 = usuer
}
```
Retorno Após success
```apacheconfig
200 OK
{
    status: "success",
    dataInsert: {
    email: "thales.rup@gmail.com",
    id: 1,
    name: "thales",
    password: "$2y$10$8vQRu1LrGKXUIJalpdYSwOBJPl0E68mols6CImgh9B9P1f/Nf0CxG",
    permission: "1"
    }
}
```

Retorno se Barrado pelo FormValidade
```apacheconfig
200 OK
{
    0: {
        Elemento Obrigatório: [
          name,
          permission
        ],
    },
    status: "error"
}
```
Retorno se Barrado pelo FormValidade validando permission
```apacheconfig
200 OK
{
    0: {
          msg: ", Escolha 1 = Administrador e 3 = Usuario "
        },
    status: "error"
}
```
URL: 
/api/admin/updateUser
<p>
Método:
POST <p>
Rota para Atualizar Usuários<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno Update success
```apacheconfig
200 OK
{
    {
        status: "success",
        dataUpdate: {
            email: "thales.rup@gmail.com",
            id: 1,
            name: "Thales Fabricio Ruppenthal",
            password: "$2y$10$hdWJo8cgq62.g7kvNQNu/eruP1sPgtonYY.hbhlfoMeirDJfQ3x7m",
            permission: "3"
        }
    }
}
```
Retorno Update error
```apacheconfig
200 OK
{
    msg: "Impossivel Salvar, id Informado Não confere",
    status: "error"
}
```

URL: 
/api/admin/deleteUser
<p>
Método:
POST <p>
Rota para Deletar Usuários<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno se Barrado pelo FormValidade
```apacheconfig
200 OK
{
    0: "Informe um id Válida",
    status: "error"
}
```
Id Não Encontrado
```apacheconfig
200 OK
{
    msg: "Impossivel Salvar, id Informado Não confere",
    status: "error"
}
```

Retorno Deletado success
```apacheconfig
200 OK
{
    status: "success",
    dataDelete: true
}
```

URL: 
/api/admin/allUser
<p>
Método:
GET <p>
Rota para Listar Usuários<p>
Rota Protegida pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno Listar Todos Usuários success
```apacheconfig
200 OK
{
    allUsers: [
      {
            email: "thales.rup@gmail.com",
            id: 1,
            name: "Thales Fabricio Ruppenthal",
            password: "$2y$10$hdWJo8cgq62.g7kvNQNu/eruP1sPgtonYY.hbhlfoMeirDJfQ3x7m",
            permission: "3"
            },
              {
            email: "thales.rup@gmail.com",
            id: 3,
            name: "Thales Fabricio Ruppenthal",
            password: "$2y$10$aaW0rJKaL.LV5ix72CblIeHkxL4EoySWoMZkozpEcNltUVep2XG9e",
            permission: "1"
            }
    ],
}
```

###### Routes Admins Tools 

URL: 
/api/admin/createAdmin
<p>
Método:
POST <p>
Rota para Criar Usuários quando não existir<p>
Obs: Rota Apenas para auxiliar nos testes, pode ser implementado uma validação de jwt que não expira para tornar a rora utilizavel em um projeto real
header-name: content-type  Header-value: application/x-www-form-urlencoded 
Retorno dela é igual ao do Inserir usuaários

Retorno Após success
```apacheconfig
200 OK
{
    status: "success",
    dataInsert: {
    email: "thales.rup@gmail.com",
    id: 1,
    name: "thales",
    password: "$2y$10$8vQRu1LrGKXUIJalpdYSwOBJPl0E68mols6CImgh9B9P1f/Nf0CxG",
    permission: "1"
    }
}
```
URL: 
/api/admin/clearTableUsers e /api/admin/clearTableJobs
<p>
Método:
POST <p>
Rota Dropar a tabela users ou jobs e todos seus dados !! Usar com cautela !!<p>
Obs: Rota Apenas para auxiliar nos testes, pode ser implementado uma validação de jwt que não expira para tornar a rora utilizavel em um projeto real
!!Sugestão: Implementar validação de usuario usando o elemento permission da tabela users
Rotas Protegidas pelo AuthController
Obs: sempre informar no cabecalho o jwt_token que veio de retorno da autenticação em /admin/login
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 

Retorno Se a tabela Não Existir ou estiver Vazia
```apacheconfig
200 OK
{
    status: "error",
    msg: "Esta Tabela Já esta Vazia ou não Existe"
}
```
Parametro Esperado
```apacheconfig
{
    table: "users"
}
```
Retorno success
```apacheconfig
200 OK
{
    status: "success",
    msg: "Amout Records Deleted 12"
}
```


##### Melhorias Possíveis

- Refatorar Router aplicando a opção de implementar Middleware, evitando repetição de códio
- Desenvolver uma camada Especifica de Abstração com Firebase, implementando uma validação de elementos e valores recebidos por requisições
Obs: Neste projeto há uma ideia singela disto, aonde valida de forma simples o tipo, usando o elemento rules de uma "tabela"
Exemplo: 
```apacheconfig
private $colunms = [
        'title'          => ['rules' => ['type' => 'string|max256', 'required' => true]],
        'description'    => ['rules' => ['type' => "string|max10000", 'required' => true]],
        'status'         => ['rules' => ['type' => 'enum|max3', 'required' => true]],
        'workplace'      => ['rules' => ['type' => 'string|*', 'required' => false]],
        'salary'         => ['rules' => ['type' => 'string|*','required' => false]],
    ];
```
Projeto já realiza a Validação, como comentei de forma Simples, exemplo:
"coluna" => title não pode ultrapassar 255 carateres, é do tipo string e é obrigatorio
- Desenvolver camada de CRUD Abstrata evitando a repetição de codigo
- Implementar Validação de id inseridos, não pude testar todas as formas de retorno, mas será necessário futuramente
para evitar duplicatas, neste mesmo contexto entra a validação que estaria neste CRUD Abstrato
- Validação de email unicos em users e caracteres minimo na senha
- Implementar Rota para importar arquivo .json que contem os dados para acesso ao banco firebase
- Melhorar Desempenho das request, isso certamente esta ligado ao "meio-campo" que cada camada faz, isso se resolve aplicando repositories e refatorando as camadas de abstração aplicando DRY e SOLID

###### Desafios Encontrados

- Pouca Documentação e exemplos de como aplicar e utilizar Firebase em projeto com PHP
- Conseguir Testar a aplicação no espaço de tempo determinado para entrega do teste
- Aplicar DRY tanto quanto possivel sem refatorar o router
- Desenvolver e Aplicar uma forma de Validar os dados das Request (FormValidate), aplicando regra de negócio sem quebrar a aplicação

## Setup
Arquivo Responsável pela Comunicação com Firebase, pode ser alteradomas precisa editar o arquivo
EngineFirebase.php alterando para o nome do arquivo que será utilizado as credenciais
```apacheconfig
    /secretJson/apijobs-84f74-firebase-adminsdk-74q22-fa72a547d0.json'
```
clone projeto se quiser:
``` bash
# clone
git clone https://github.com/carlosfgti/crud-laravel-5.7.git

# Access project
cd crud-laravel-5.7
```
Se for zip
``` bash
# Descompactar

# Rodar WAMP, LAMP, MAMP, ou XAMPP
arquivo .htaccess não esta pronto para ser usado com comando
do servidor php embito ex: php -S localhost:8000
Apos descompactar e iniciar serviço do WAMP, LAMP, MAMP, ou XAMPP
Acessar pelo Browser http://localhost/apiRouter/api/public/allJobs
ou pela ferramenta escolhida como postman ou advancedRest
e utilizar

# Acessar Pelo Browser:
localhost/apiRouter/api + rota exemplo /public/allJobs
http://localhost/apiRouter/api/public/allJobs

# Por Software para testes de api, segue o mesmo exemplo acima
Selecionar metodo setar url => localhost/apiRouter/api/public/allJobs
Respeitar os Parametros minimos para serem enviados

Exemplo :
## Cabeçalho
Request POST
header-name: Authorization  Header-Value: Bearere + jwt_token
header-name: content-type  Header-value: application/x-www-form-urlencoded 
```

#### Condiderações Finais

Evolui como Desenvolvedor com este pequeno Projeto, certamente há muitas formas de refatorar ele e aperfeiçoa-lo, não pude testar completamente.
Espero suprir as expectativas, estou disponivél se surgirem duvidas. Desde já agradeço a oportunidade.
Att. Thales F Ruppenthal