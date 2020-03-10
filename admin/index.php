<?php include_once('estrutura/header.php') ?>


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Hoje o sistema possui <b id="vagas"></b> vagas cadastradas!</div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Hoje são <b id="vagasinativas"></b> vagas inativas</div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Hoje são <b id="vagasativas"></b> vagas ativas</div>

                                </div>
                            </div>
                            
                        </div>

                </div>
            </div>
        </div>
    </div>
</main>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){  

     
    $.ajax({
        method:"POST",
        url: "../backend/selectVagasEstatisticas.php?proc=numVagasAtivas"
    }).done(function(data) {
        console.log(data)
        $('#vagasativas').html(data)
    });

    $.ajax({
        method:"POST",
        url: "../backend/selectVagasEstatisticas.php?proc=numVagasInativas"
    }).done(function(data) {
        console.log(data)
        $('#vagasinativas').html(data)
    });

    $.ajax({
        method:"POST",
        url: "../backend/selectVagasEstatisticas.php?proc=numtotalVagas"
    }).done(function(data) {
        console.log(data)
        $('#vagas').html(data)
    });


});
</script>


<?php include_once('estrutura/footer.php') ?>