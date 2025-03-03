<?php
session_start();
 if (!isset($_SESSION['nome']) and !isset($_SESSION['senha'])) {
  //Destrói
  session_destroy();
  //Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  //Redireciona para a página de autenticação
  header('location:login.php');
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
    <title>Apresentação de crianças</title>
  </head>
  <body>
   <div class="container">
           <hr>
   	       <h1>Emissão de Certificado de Apresentação de Crianças </h1>
   	       <br>
   	       <hr>
<!-- -->    <form action="dados_certificado.php" method="GET">

				<div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="nome">Nome do Pai</label>
				      <input type="text" class="form-control" id="nome" name="nome_pai">
				    </div>
                    <div class="form-group col-md-6">
				      <label for="cidade">Nome da Mãe</label>
				      <input type="text" class="form-control" id="cidade" name="nome_mae">
				    </div>
				</div>
				<div class="form-row">
                    <div class="form-group col-md-6">
				      <label for="cidade">Nome da Criança</label>
				      <input type="text" class="form-control" id="cidade" name="nome_crianca">
				    </div>
                    <div class="form-group col-md-6">
				      <label for="cidade">Data da Apresentação</label>
				      <input type="date" class="form-control" id="cidade" name="dt_apresentacao">
				    </div>
				</div>

				  	  
				  
				  
				  <button type="submit" class="btn btn-primary">Emitir Certificado</button>
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