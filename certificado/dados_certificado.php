<?php
session_start();
if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
 header('location:../login.php');   
  } 
	        $nome_pai = $_GET['nome_pai'];
	        $nome_mae = $_GET['nome_mae'];
	        $nome_crianca = $_GET['nome_crianca']; 
            $dt_apresentacao = $_GET['dt_apresentacao']     
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' href='certificado.css'>
    <link rel='stylesheet' href='../css/meuEstilo.configuracao_impressao.css'>
    
    <title>Emissão de Certificado Criança</title>
</head>
<body>

<style>
    @media print {
        @page {
            size: A4 landscape;
        }
        nav {
            display: none;
        }
    }
</style>
<div class="container">
<br>    
<nav style="margin-left:50px;">
    <a href="#" onclick="window.print();" style="text-decoration:none;">
        <p id="texto_imprimir" style="color:#778899;"><?php echo rand(1,10)."   |  "."Imprimir";?></p>
    </a>
</nav>

    <div class="img_certificado">
        <img id="certificado" src="../imagens/diversas_imagens/certificado.png" alt="" srcset="">
    </div>
    <div id="nome_pai"><?php echo $nome_pai ;?></div>
    <div id="nome_mae"><?php echo $nome_mae ;?></div>
    <div id="nome_crianca"><?php echo $nome_crianca ;?></div>
    <div id="dt_apresentacao">
    <p><strong>Data de Apresentação: </strong><?php echo date('d/m/Y', strtotime($dt_apresentacao)); ?>
    </p>
</div>
<br>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>









