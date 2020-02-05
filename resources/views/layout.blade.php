<html html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vagas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
     <a class="navbar navbar-expand-lg" href="{{ route('vagas.index') }}">Home</a>
     @auth
     <span class="mr-4">
        <?php
           echo "Welcome: ".Auth::user()->name;
        ?>
    </span>
        <a class="text-danger" href="/sair">Sair</a>
     @endauth

    @guest
    <a href="/logar">Entrar</a>
    @endguest
</nav>

    <div class="container">
        <div class="jumbotron">
            <h1>@yield('cabecalho')</h1>
        </div>
    </div>
    {{-- <a href="{{ route('vagas.create') }}" class="btn btn-dark ml-2 mb-3" >Adicinar</a> --}}
    @yield('conteudo')
</body>

</html>