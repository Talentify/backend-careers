<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vagas Bataiero</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/small-business.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark  fixed-top" style="background-color: teal;">
    <div class="container">
      <a class="navbar-brand" href="#">Vagas Bataiero</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link btm btn-success"  style="color:white" href="../login.html">Cadastre uma Vaga</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8" style="min-height:600px;">

        <!-- Title -->
        <h1 class="mt-4" id="tituloVaga"></h1>

        <hr>

        <!-- Date/Time -->
        <p>Posted on January 1, 2019 at 12:00 PM</p>

        <hr>

        <!-- Post Content -->
        <p class="lead"  id="descricaoVaga"><b>Description: </b></p>

        <p class="lead"  id="workplace"><b>Workplace: </b></p>

        <p class="lead"  id="salary"><b>Salary: $</b></p>

        <a href="index.html">Voltar</a>
          <br>

</div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
      <img src="img/miolo.jpg" width="350px"alt="">

        

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Desenvolvido por Rafael Bataiero - 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script type="text/javascript">
  
  $(document).ready(function(){  
    
    var vaga = <?php echo $_GET['vaga'];?>

    console.log(vaga)

    $.ajax({
        method:"POST",
        url: "../backend/pegaDadosVaga.php",
        data:{
        vaga: vaga
        }
    }).done(function(data) {
        console.log(JSON.parse(data))

          var dados = JSON.parse(data)
          $('#tituloVaga').append(dados.title)
          $('#descricaoVaga').append(dados.description)
          $('#workplace').append(dados.workplace)
          $('#salary').append(dados.salary)

    });

  });
  </script>



</body>

</html>
