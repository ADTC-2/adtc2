<?php

require 'db/config.php';
session_start();


if (isset($_POST['nome']) && empty($_POST['nome']) == false) {

	$nome = addslashes($_POST['nome']);

	$senha = md5(addslashes($_POST['senha']));

} 	
 	 $sql = $pdo->query("SELECT * FROM usuarios WHERE nome='$nome' AND senha='$senha'");

if($sql->rowCount() > 0) {

     foreach($sql->fetchAll() as $linhas){    
 	 
          
          session_regenerate_id();

          $_SESSION['email']  = $linhas['nome'];
          $_SESSION['senha']  = $linhas['senha'];
          $_SESSION['nivel']  = $linhas['nivel'];


          if ($_SESSION['nivel'] === "admin") {
               header('Location:index.php');
          }elseif($_SESSION['nivel'] === "apoio"){
               header('Location:index_secretario.php');  
          }else{
               header('Location:login_erro.php');  
          }

   
}
           

}else{

        session_destroy();
        session_unset($_SESSION['email']);
        session_unset($_SESSION['senha']);
        session_unset($_SESSION['nivel']);
        header("Location:login_erro.php");         
        exit(); 
}



?>		