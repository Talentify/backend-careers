<h1>Testes</h1>
<br/><br/>
<p>Passos</p>
<br>

<ul>
    <ol>Fazer download o repository</ol>
    <ol>Dezipar o arquivo</ol>
    <ol>Abrir o terminal/command prompt(cmd)</ol>
    <ol>Executar: docker-compose up -d</ol>
    <ol>Executar: docker exec app composer install --working-dir=/usr/share/nginx</ol>
    <ol>Esperar o termino de processos </ol>
    <ol>Executar: docker exec app php /usr/share/nginx/artisan migrate</ol>
    <ol>Esperar o termino de processos </ol>
    <ol>Executar: docker exec app php /usr/share/nginx/artisan passport:client --client</ol>
    <ol>Esperar o termino de processos </ol>
    <ol>Entrar no navegador: http:/localhost:8080</ol>
</ul>

<br/>

<p>APIS ROTAS</p>
<br/>
<ul>
    <ol>http://localhost:8080/api/login (Apenas POST)</ol>
    <ol>http://localhost:8080/api/companies (Todos POST e GET)</ol>
    <ol>http://localhost:8080/api/recruiters (Todos POST e GET)</ol>
    <ol>http://localhost:8080/api/vacancies (Todos métodos)</ol>
</ul>

<p>SQLS/Banco Dados</p>
<br/>
<ul>
    <ol>Host: postgres | User: postgres | DB: postgres | passowrd: gustavo</ol>
    <ol>Dentro da pasta raiz, possuem uma pasta chamado SQLS | faça uma importação de dados, para terem dados</ol>
</ul>
<br/><br/>
<h3>Para executar o php unitário: docker exec app /usr/share/nginx/vendor/bin/phpunit</h3>
<br/><br/>
<h3>Observação</h3>
<br/>
<p>Não consegui colocar o elasticsearch no docker, então coloquei direto no "Model", para não atrasar mais dias.
<br>/
Pois não tenho conhecimento no elasticsearch(pouco), somente o conceito, mas eu estou disposto a aprender, correr atrás
</p><br/>
<p>Obrigado, Gustavo!</p>