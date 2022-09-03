<?php
session_start();


if ( !isset($_SESSION['email']) and !isset($_SESSION['email']) ) {
  //Destrói
  session_destroy();

  //Limpa
  unset ($_SESSION['email']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:../login.php');
}

require '../db/config.php';


//Caso o usuário não esteja autenticado, limpa os dados e redireciona


$id_dizimo 		= $_GET["id_dizimo"];


$sql = "DELETE FROM dizimo WHERE id_dizimo= $id_dizimo";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/cadastrar_dizimo.php'>
				<div id='status' class='alert alert-success'></div>
			";		   
		}
		 else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/cadastrar_dizimo.php'>
				<div id='status' class='alert alert-danger'></div>
			";		   

		}

		?>
	</body>
</html>