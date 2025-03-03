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
$id           = $_POST['id'];
$solicitante  = addslashes($_POST['solicitante']);
$tipo_evento  = addslashes($_POST['tipo_evento']);
$horario      = addslashes($_POST['horario']);
$data_evento  = addslashes($_POST['data_evento']);
$telefone     = addslashes($_POST['telefone']);
$situacao     = addslashes($_POST['situacao']);



$sql = "UPDATE agendamento SET solicitante='$solicitante',tipo_evento='$tipo_evento',horario='$horario',data_evento='$data_evento',telefone='$telefone',situacao='$situacao' WHERE id ='$id'";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_agendamento.php'>
				<script type=\"text/javascript\">
					alert(\"Agendamento alterado com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_agendamento.php'>
				<script type=\"text/javascript\">
					alert(\"Agendamento não foi alterado .\");
				</script>
			";		   

		}

		?>
	</body>
</html>