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
$id                       = $_POST['id'];
$evento                   = addslashes($_POST['evento']);
$anotacoes                = addslashes($_POST['anotacoes']);
$congregacao              = addslashes($_POST['congregacao']);
$dt_evento                = addslashes($_POST['dt_evento']);
$situacao                 = addslashes($_POST['situacao']);



$sql = "UPDATE eventos SET evento='$evento',anotacoes='$anotacoes',congregacao='$congregacao',dt_evento='$dt_evento',situacao='$situacao' WHERE id ='$id'";
$sql=$pdo->query($sql);

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
				<script type=\"text/javascript\">
					alert(\"Evento alterado com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_eventos.php'>
				<script type=\"text/javascript\">
					alert(\"Evento não foi alterado .\");
				</script>
			";		   

		}

		?>
	</body>
</html>