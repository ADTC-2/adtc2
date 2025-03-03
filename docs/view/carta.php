<?php
session_start();
if ( !isset($_SESSION['email']) and !isset($_SESSION['email']) ) {  
  //Limpa
  unset ($_SESSION['email']);
 unset ($_SESSION['senha']);  
  //Redireciona para a página de autenticação
  header('location:../login.php');   
  } 
       
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' href='../css/meuEstilo.css'>
    <link rel='stylesheet' href='../css/meuEstilo.configuracao_impressao.css'>
    <title>Solitações de Carta</title>
  </head>
  <body>
   <div class="container">

   	       <h1>Emissão de Cartas </h1>
   	       <h4>Secretara Online</h14>
   	       <hr>
<!-- -->    <form action="dados_da_carta.php" method="GET">

				<div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="nome">Nome</label>
				      <input type="text" class="form-control" id="nome" name="nome">
				    </div>

				    <div class="form-group col-md-6">
				      <label for="estadocivil">Estado Civil</label>
				      <select id="estadocivil" class="form-control" name="estadocivil">
				     <option selected>Selecione uma opção...</option>
                      <option>Casado</option>
                      <option>Casada</option>
                      <option>Solteiro</option>
                      <option>Solteira</option>
                      <option>Divorciado</option>
                      <option>Divorciada</option>
                      <option>Viuvo</option>
                      <option>Viuva</option>
                      <option>Separado</option>
                      <option>Separada</option>
				      </select>
				    </div>
				</div>
				<div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="cidade">Cidade de destino</label>
				      <input type="text" class="form-control" id="cidade" name="cidade">
				    </div>

				    <div class="form-group col-md-6">
				      <label for="estadocivil">Função</label>
				      <select id="estadocivil" class="form-control" name="funcao">
				        <option selected>Selecione uma opção...</option>
				        <option>Membro</option>
				        <option>Auxiliar</option>
				        <option>Diacono</option>
				        <option>Presbitero</option>
				        <option>Evangelista</option>
				        <option>Pastor</option>
				      </select>
				    </div>
				</div>

				  	  
				  
				  
				  <button type="submit" class="btn btn-primary">Emitir Carta</button>
            </form>
   </div> 
   <footer>
   	<p style="text-align:center; ">CodigoQuatro | <?php echo date('Y')?></p>
   </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
