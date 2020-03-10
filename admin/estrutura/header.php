<?php
session_start();
if($_SESSION['login_ativo'] == 0){
 header('Location:../login.html');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admistração Vagas ROB</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Admistração Vagas </a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                <a class="" href="../backend/logoff.php" style="background:white; padding:20px 10px; text-decoration:none; font-weight:bold">Sair</a>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <a class="nav-link"  href="../plataforma/index.html" target="_blank">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Ir para Plataforma</a
                            >
                           

                            <div class="sb-sidenav-menu-heading">Gerenciamento</div>
                            <a class="nav-link collapsed" href="index.php" 
                                ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Inicio</a>
                            <a class="nav-link collapsed" href="gerencia_vagas.php" 
                                ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Vagas</a>


                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado como:</div>
                        <p>Start Bootstrap</p>
                    </div>
                </nav>
            </div>