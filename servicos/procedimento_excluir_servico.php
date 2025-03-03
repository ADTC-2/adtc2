<?php
session_start();


if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {
  //Destrói
  session_destroy();

  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:../login.php');
}

require '../db/config.php';


//Caso o usuário não esteja autenticado, limpa os dados e redireciona


$id		= $_GET["id"];


$sql = "DELETE FROM  eventos  WHERE  id = $id";
$sql =$pdo->query($sql);


?> 
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if ($sql->rowCount() != 0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_eventos.php'>
				<div id='status' class='alert alert-success'></div>
			";		   
		}
		 else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_eventos.php'>
				<div id='status' class='alert alert-danger'></div>
			";		   

		}

		?>
	</body>
</html>