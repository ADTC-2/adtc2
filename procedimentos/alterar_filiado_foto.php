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


/*

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
$datCadastro                    = $_POST['datCadastro'];

*/
		
			$_UP['pasta'] = '../sistema/imagens/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = true;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = @strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
					<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extensão válida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				if(@$UP['renomeia'] == true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = time().'.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
                     					
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem cadastrado com Sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem não foi cadastrado !!\");
						</script>
					";
				}
			}

//$data		= date('Y-m-d');
$arquivo=$_FILES['arquivo']['name'];

$sql = "UPDATE filiado SET arquivo='$arquivo' WHERE matricula='$matricula'";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/painel_adm.php'>
				<script type=\"text/javascript\">
					alert(\"Foto alterada com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/painel_adm.php'>
				<script type=\"text/javascript\">
					alert(\"Foto não foi alterado .\");
				</script>
			";		   

		}

		?>
	</body>
</html>