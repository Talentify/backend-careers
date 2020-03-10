<?php
session_start();
$_SESSION['login_ativo'] = 0;
unset($_SESSION);
header('Location:../login.html');
?>