<?php
session_start();
if($_SESSION['login_ativo'] == 1){
    header('Location: plataforma/index.html');
}else{
    header('Location: login.html');
}
?>