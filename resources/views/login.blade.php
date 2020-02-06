<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"
   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
   crossorigin="anonymous"></script>
   <title>Talentify - Vagas de Emprego</title>
</head>
<body>
   <style>
      .caixa{
         height: 150px;
         background: red;
         margin: 30px 0px 0px 0px;
      }
   </style>
   <div class="container">
         <div class="col-md-6">
            <h2>Login de usuário</h2>
         </div>
         <div class="col-md-6">
            <a href="{{ route('login') }}">
               <button style="float:right; margin-top:30px" class="btn btn-primary">
                  Login
               </button>
            </a>
         </div>
         <div class="col-md-12">
            <hr style="border:1px solid #000">
         </div>

         <div style="margin-top:50px; border: 1px solid #000; padding: 20px; background: #ececec" class="col-md-4 col-md-offset-4">
         <form method="post" action="{{ route('login') }}">
            @csrf
               <h3 align="center">Dados de Acesso</h3>
               <hr>
               <input required class="form-control" type="text" name="usuario" placeholder="Nome de Usuário">
               <br>
               <input required class="form-control" type="password" name="senha" placeholder="******">
               <br>
               <div class="col-md-6 col-md-offset-3">
                  <button style="width: 100%" class="btn btn-success">Entrar</button>
               </div>
            </form>
         </div>

         <div class="col-md-12">
            <br>
         </div>


         <div style="padding:0" class="col-md-4 col-md-offset-4">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert">&times;</a></p>
              @endif
            @endforeach
         </div>
   </div>
</body>
</html>