<?php include_once('estrutura/header.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Vagas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Gerenciador</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <a href="vaga.php"><div class="card-body" style="color:white;font-weight:bold">+ Adicionar Vaga</div></a>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>                                             
                                                <th>Workplace</th>
                                                <th>Salary</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>                                             
                                                <th>Workplace</th>
                                                <th>Salary</th>
                                                <th>Status</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="listaVagas">
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>




<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){  
    var intervalo = setInterval(function() { $('#listaVagas').load('../backend/selectVagas.php'); }, 1000);

    $('#btn_del').click(function(){
        var a = $('.btn_del').attr('alt');
        alert(a)
    })


});
</script>

<?php include_once('estrutura/footer.php') ?>