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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>
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
            <h2>Cadastro de vagas</h2>
         </div>
            <div class="col-md-6">
               <a href="{{ route('logout') }}">
                  <button style="float:right; margin-top:30px" class="btn btn-danger">
                     Logout
                  </button>
               </a>

               <a href="{{ route('lista.vagas') }}">
                  <button style="float:right; margin-top:30px; margin-right:10px" class="btn btn-primary">
                     Página Inicial
                  </button>
               </a>
            </div>

            <div class="col-md-12">
               <hr style="border:1px solid #000">
            </div>

         <form method="post" action="{{ route('adm.cadastro') }}">
            @csrf
            <div style="margin-top:50px" class="col-md-12">
               <div class="col-md-5">
                  <input required name="title" placeholder="Título da vaga (Obrigatório)" type="text" class="form-control">
               </div>

               <div class="col-md-12">
                  <br>
               </div>

               <div class="col-md-12">
                  <textarea required placeholder="Descrição da Vaga (Obrigatório)" style="min-width:100%; max-width: 100%; min-height: 130px; max-height:130px" class="form-control" name="description" id=""></textarea>
               </div>

               <div class="col-md-12">
                  <br>
               </div>

               <div class="col-md-4">
                  <select required class="form-control" name="status" id="">
                     <option value="">Selecione o status da vaga...</option>
                     <option value="ativo">Ativo</option>
                     <option value="inativo">Inativo</option>
                  </select>
               </div>

               <div class="col-md-6">
                  <input class="form-control" placeholder="Endereço" name="workplace" type="text">
               </div>

               <div class="col-md-2">
                  <input data-thousands="" id="salary" class="form-control" placeholder="Salário (USD)" name="salary" type="text">
               </div>

               <div class="col-md-12">
                  <hr>
               </div>

               <div class="col-md-3 col-md-offset-9">
                  <button style="width: 100%" class="btn btn-success">
                     Cadastrar Vaga
                  </button>
               </div>

               <div class="col-md-12">
                  <br>
               </div>

               <div class="col-md-12">
                  <div class="flash-message">
                     @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                       @if(Session::has('alert-' . $msg))
                       <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert">&times;</a></p>
                       @endif
                     @endforeach
                   </div>
               </div>
            </div>
         </form>
   </div>

   <script>
      $(function() {
    $('#salary').maskMoney();
  })
   </script>
</body>
</html>