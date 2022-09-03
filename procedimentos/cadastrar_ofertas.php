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

require'../db/config.php';

if (isset($_POST['dataOferta']) && empty($_POST['dataOferta']) == false) {
$dados=array(
addslashes($_POST["dataOferta"]),
addslashes($_POST["valor"]),
addslashes($_POST["responsavel"])

);

}

$data		= date('Y-m-d');

$sql = "INSERT INTO ofertas (dataOferta,valor,responsavel) VALUES('$dados[0]','$dados[1]','$dados[2]')";
$sql = $pdo->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if ($sql->rowCount() > 0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_ofertas.php'>
				<script type=\"text/javascript\">
					alert(\"Oferta cadastrada com Sucesso.\");
				</script>
			";		   
		}
		 else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_ofertas.php'>
				<script type=\"text/javascript\">
					alert(\"Oferta não foi cadastrada com Sucesso.\");
				</script>
			";		   

		}

		?>
	</body>
</html>
