<?php include_once('estrutura/header.php') ?>


<style>
    input[type=text],textarea{   
        width:600px;
        height:50px;
    }
    input[type=text]:hover, textarea:hover{ 
            background: #ffffff; border:1px solid #990000;
    }
    label{font-weight:bold}
</style>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Adicionar Vaga</h1>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-xl-14">
                                 <form class="form-horizontal">
                                    <fieldset>
                                        <!-- Text input-->
                                        <div class="form-group">
                                        <label class="col-md-12 control-label" for="textinput">Title</label>  
                                        <div class="col-md-12">
                                        <input id="Title" name="Title" type="text" class="form-control input-md" maxlength="256" >
                                        </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                        <label class="col-md-12 control-label" for="textinput">Description</label>  
                                        <div class="col-md-12">
                                        <textarea class="form-control" id="Description" name="Description" maxlength="1000" required></textarea>
                                        </div>
                                        </div>
               
                                        <!-- Multiple Radios (inline) -->
                                        <div class="form-group">
                                        <label class="col-md-12 control-label" for="textarea">Status</label>
                                        <div class="col-md-12"> 
                                            <label class="radio-inline" for="radios-0">
                                            <input type="radio" name="Status"  class="Status" id="radios-0" value="1" required checked="checked">
                                            Ativo
                                            </label> 
                                            <label class="radio-inline" for="radios-1">
                                            <input type="radio" name="Status"  class="Status" id="radios-1" value="0">
                                            Inativo
                                            </label> 
                                        </div>
                                        </div>
       

                                        <!-- Text input-->
                                        <div class="form-group">
                                        <label class="col-md-12 control-label" for="textinput">Workplace</label>  
                                        <div class="col-md-12">
                                        <input id="Workplace" name="Workplace" type="text" class="form-control input-md">
                                        </div>
                                        </div>


                                        <!-- Text input-->
                                        <div class="form-group">
                                        <label class="col-md-12 control-label" for="textinput">Salary</label>  
                                        <div class="col-md-12">
                                        <input id="Salary" name="Salary" type="text" class="form-control input-md">
                                        </div>
                                        </div>



                                        <!-- Button -->
                                        <div class="form-group">
                                        <div class="col-md-12">
                                        <button id="btn_cadastrar" name="btn_cadastrar" class="btn btn-primary">Cadastrar</button>
                                        &nbsp<a href="gerencia_vagas.php">Voltar</a>
                                        </div>
                                        </div>

                                    </fieldset>
                                </form>

                            </div>
                        </div>

                    </div>
                </main>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $('#btn_cadastrar').click(function(){
        event.preventDefault();
        var Title = $('#Title').val()
        var Description = $('#Description').val()
        var Status = $('.Status').val()
        var Workplace = $('#Workplace').val()
        var Salary = $('#Salary').val()

        if(Title.length && Description.length && Status.length){

            $.ajax({
                method:"POST",
                url: "../backend/insert.php",
                data:{
                Title: Title, 
                Description:Description, 
                Status:Status, 
                Workplace:Workplace, 
                Salary:Salary}
            }).done(function(data) {
                console.log(data)
                if(data == 1){
                    alert('Vaga cadstrada com sucesso!')
                    $('#Title').val("")
                    $('#Description').val("")
                    $('.Status').val("")
                    $('#Workplace').val("")
                    $('#Salary').val("")

                }
            });

          
        }else{
            lert('Error: Vaga Não cadstrada!')

        }


    });
});
</script>


<?php include_once('estrutura/footer.php') ?>