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
            <h2>Vagas de emprego</h2>
         </div>
         <div class="col-md-6">
            @if(isset(auth()->user()->id))
               <a href="{{ route('logout') }}">
                  <button style="float:right; margin-top:30px" class="btn btn-danger">
                     Logout
                  </button>
               </a>

               <a href="{{ route('adm.index') }}">
                  <button style="float:right; margin-top:30px;margin-right: 10px" class="btn btn-warning">
                     Painel Administrativo
                  </button>
               </a>

            @else
            <a href="{{ route('login') }}">
               <button style="float:right; margin-top:30px" class="btn btn-primary">
                  Login
               </button>
            </a>
            @endif
         </div>
         <div class="col-md-12">
            <hr style="border:1px solid #000">
         </div>

         <div style="margin-top:50px" class="col-md-12">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <td><b>Título</b></td>
                     <td><b>Descrição</b></td>
                     <td><b>Salário</b></td>
                     <td><b>Local</b></td>
                     <td><b>Status</b></td>
                  </tr>
               </thead>
               <tbody>
                  @foreach($dados AS $key => $val)
                     <tr>
                        <td>{{ $val['title'] }}</td>
                        <td>{{ $val['description'] }}</td>
                        <td>{{ ($val['salary']) ?? "-" }}</td>
                        <td>{{ ($val['workplace']) ?? "-" }}</td>
                        <td>{{ ($val['status'] == 'ativo') ? "Ativo" : "Inativo" }}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
   </div>
</body>
</html>