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


$nome           = $_POST['nome'];
$congregacao    = $_POST['congregacao'];
$valor          = $_POST['valor'];
$responsavel    = $_POST['responsavel'];		
$data		    = date('Y-m-d');


$sql = "INSERT INTO  dizimo SET nome='$nome',congregacao='$congregacao',valor='$valor',responsavel='$responsavel',dataCaptura='$data'";
 $sql = $pdo->query($sql);

 ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body> 
<?php
		if ($sql->rowCount() >0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_dizimos_lancados.php'>
				<script type=\"text/javascript\">
					alert(\"Dizimo lançado com Sucesso.\");
				</script>
			";		   
		}
		 else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../sistema/view/tela_dizimos_lancados.php'>
				<script type=\"text/javascript\">
					alert(\"Dizimo não foi lançado !!.\");
				</script>
			";		   

			}

		?>
		
	</body>
</html>




