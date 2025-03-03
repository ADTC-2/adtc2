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




$matricula                      = $_POST['matricula'];
$nome                           = $_POST['nome'];
$funcao                         = $_POST['funcao'];
$congregacao                    = $_POST['congregacao'];
$documento                      = $_POST['documento'];
$dataNascimento                 = $_POST['dataNascimento'];
$dataBatismo                    = $_POST['dataBatismo'];
$estadoCivil                    = $_POST['estadoCivil'];
$mae                            = $_POST['mae'];
$pai                            = $_POST['pai'];
$logradouro                     = $_POST['logradouro'];
$endereco                       = $_POST['endereco'];
$numero                         = $_POST['numero'];
$bairro                         = $_POST['bairro'];
$cep                            = $_POST['cep'];
$cidade                         = $_POST['cidade'];
$uf                             = $_POST['uf'];
$telefone                       = $_POST['telefone'];  
$email                          = $_POST['email'];
$status                         = $_POST['status'];
$datCadastro                    = $_POST['datCadastro'];
$arquivo                        = $_POST['arquivo'];

$data	                    	= date('Y-m-d');


$sql = "UPDATE filiado SET nome='$nome',funcao='$funcao',congregacao='$congregacao',documento='$documento',dataNascimento='$dataNascimento',dataBatismo='$dataBatismo',estadoCivil='$estadoCivil',mae='$mae',pai='$pai',logradouro='$logradouro' ,endereco='$endereco',numero='$numero',bairro='$bairro',cep='$cep',cidade='$cidade',uf='$uf',telefone='$telefone',email='$email',status='$status',datCadastro='$datCadastro',arquivo='$arquivo' WHERE matricula='$matricula'";
$sql=$pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php

		if ($sql->rowCount() !=0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_controle_filiado.php'>
				<script type=\"text/javascript\">
					alert(\"Filiado alterado com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_controle_filiado.php'>
				<script type=\"text/javascript\">
					alert(\"Filiado não foi alterado .\");
				</script>
			";		   

		}

		?>
	</body>
</html>