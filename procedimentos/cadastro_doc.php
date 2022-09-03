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
if (isset($_POST['descricao']) && empty($_POST['descricao']) == false) {
	$dados=array(

addslashes($_POST['descricao']), 
addslashes($_POST['tipo']),
addslashes($_POST['responsavel'])

);
}

$arquivo=$_FILES['arquivo']['name'];



			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = '../documentos/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 2048*2048*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif' ,'pdf' ,'xls' ,'doc' ,'xlsx' ,'xlsm' ,'docx','txt' ,'pptx');
			
			//Renomeiar
			$_UP['renomeia'] = false;
			
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
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/gestao_doc_cadastro.php'>
					<script type=\"text/javascript\">
						alert(\"O arquivo não foi cadastrado extensão válida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/gestao_doc_cadastro.php'>
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
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/gestao_doc_cadastro.php'>
						<script type=\"text/javascript\">
							alert(\"Arquivo cadastrado com Sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/gestao_doc_cadastro.php'>
						<script type=\"text/javascript\">
							alert(\"Arquivo não foi cadastrado !!\");
						</script>
					";
				}
			}
			
			
$data		= date('Y-m-d');
$arquivo=$_FILES['arquivo']['name'];		
$sql = "INSERT INTO documentos(descricao,tipo,responsavel,dataCadastro,arquivo)VALUES('$dados[0]','$dados[1]','$dados[2]','$data','$arquivo')";
 $sql = $pdo->query($sql);

 ?>
<?php
		if ($sql->rowCount() > 0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/gestao_doc_cadastro.php'>
				<script type=\"text/javascript\">
					alert(\"Documento cadastrado com Sucesso.\");
				</script>
			";		   
		}
		 else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/gestao_doc_cadastro.php'>
				<script type=\"text/javascript\">
					alert(\"Documento não foi cadastrado !!.\");
				</script>
			";		   

		}

		?>




