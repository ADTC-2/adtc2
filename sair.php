<?php
session_start();
session_destroy();

//Remove todas as informações contidas na variaveis globais
unset($_SESSION['Id'],			
$_SESSION['nome'], 		
$_SESSION['login'], 
$_SESSION['email'], 		
$_SESSION['senha'],
$_SESSION['dataCaptura']);
//redirecionar o usuário para a página de login
header("Location:login.php");
?>
