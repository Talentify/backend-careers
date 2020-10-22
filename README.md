#Setup

#####Requesitos: 
- Docker
- Docker Compose
- Bash
- Make ( Linux e macOS/BSD ) ou Git CLI no Windows  [Download do upgrade de Git CLI](https://github.com/havennow/upgrade-git-cli)

---

####Rodar os seguintes comandos, para iniciar o projeto:
    
1) ``make build``  - esse comando constrói os containers do Docker
2) ``make install`` - esse comando instala dependências, executa migrate e data fixture
3) ``make start`` - esse comando sobe todos containers
4) ``make shell`` - esse comando entra no shell/bash do container principal "backend", acesso ao php cli e composer  
5) ``make stop`` - esse comando para todos containers

---

###Rotas:

- Login: admin 
- Senha: admin

#####RESTful

1) ``http://localhost/api/v1/login`` - content type: JSON, method POST, campos: email, password - retorna JWT
2) ``http://localhost/api/v1/users/create`` - content type: JSON, method POST, Auth Bearer JWT Token,  campos: email, password e roles
3) ``http://localhost/api/v1/users`` - method GET, retorna lista de usuários
4) ``http://localhost/api/v1/users/{\d}`` - Auth Bearer JWT Token, method GET, retorna dados de um registro único
5) ``http://localhost/api/v1/users/{\d}/update`` - content type: JSON, method PUT, Auth Bearer JWT Token, campos: email, password e roles
6) ``http://localhost/api/v1/users/{\d}/delete`` - content type: JSON, method PUT, Auth Bearer JWT Token, deleta o registro
7) ``http://localhost/api/v1/jobs/create`` - content type: JSON, method POST, Auth Bearer JWT Token, campos: title, workplace, description, status, salary
8) ``http://localhost/api/v1/jobs`` - method GET, retorna lista de jobs
9) ``http://localhost/api/v1/jobs/{\d}`` - Auth Bearer JWT Token, method GET, retorna dados de um registro único
10) ``http://localhost/api/v1/jobs/{\d}/update`` - content type: JSON, method: PUT, Auth Bearer JWT Token, campos: title, workplace, description, status, salary
11) ``http://localhost/api/v1/jobs/{\d}/delete`` - content type: JSON, method: DELETE, Auth Bearer JWT Token, deleta o registro
12) ``http://localhost/api/v1/users/search`` - method GET, parametros de busca query string : email 
13) ``http://localhost/api/v1/jobs/search`` - method GET, parametros de busca query string : title e workplace 
