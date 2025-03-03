<?php
session_start();
if ( !isset($_SESSION['email']) and !isset($_SESSION['email']) ) {  
  //Limpa
  unset ($_SESSION['email']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
 header('location:../login.php');   
  } 
	        $nome = $_GET['nome'];
	        $funcao = $_GET['funcao'];
	        $estadocivil = $_GET['estadocivil'];
	        $cidade = $_GET['cidade'];
    
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
    
    <title>Modelo</title>
  </head>
  <body>
  <style type="text/css">
  	
  </style>
<!-- -->
  <div class="container">
     <nav style="margin-left:50px;">
     	<a href="#" onclick="window.print();" style="text-decoration:none;">
     		<p>Impressão de número <?php echo rand(1,10);
?></p>
     	</a>
     </nav>
  	

    <div id="pagina" class="col-sm-12">
    <div class="row">
    	<div id="info_cabecalho" class="col-sm-12">

    	   <p style="margin-bottom:0px;text-align:center;"><img src="../imagens/img_carteira/logo sem fundo.png" alt="" class="img-fluid" width="120" height="90"></p>
    	   <p style="margin-bottom:0px;text-align:center; ">ASSEMBLÉIA DE DEUS TEMPLO CENTRAL II - Maranguape - CE</p>
        </div>
    </div>
    	
   
    <div class="row">
	  	<div id="info_cabecalho">
	  		<b>Nome : <?php echo $nome ;?></b><br>	  		
	  		<b>Cargo : <?php echo $funcao ;?></b><br>
	  		<b>Estado Civil : <?php echo $estadocivil ;?></b><br>
	  		<b>Cidade de destino : <?php echo $cidade;?></b><br>
	  	</div>
    </div>
    <hr>
    <div class="row">
	  	<div id="info_tipocarta" class="col-sm-12">
	  		<p style="font-size:27px;">Tipo de Carta</p> 

                  <label class="checkbox-inline"style="font-size:20px;"><input type="checkbox" value="" id="check">  Mudança</label>
                  <label class="checkbox-inline"style="font-size:20px;"><input type="checkbox" value=""id="check">  Recomendação</label>
                  <label class="checkbox-inline"style="font-size:20px;"><input type="checkbox" value=""id="check">  Em Trânsito</label>
     	</div>
    </div>
   
	<div class="row">
	  	<div id="info_texto" class="col-sm-12">  		
	  	
		    <p style="font-size:27px;"> Saudações no Senhor</p> <br><br><br>	
	
	        <p>Por se achar em pleno gozo e comunhão, nós o (a) recomendamos para que recebais no Senhor como se usa fazer os santos.
	        Pela <b>Igreja Evangélica Assembléia de Deus Templo Central II</b>.Localizada a Rua Coronel Antônio Botelho - Parque Santa Fé - Maranguape - CE.</p> <br><br><br>
            </p>
	        <p><strong>“Nossa carta sóis vós, carta escrita em nossos corações, reconhecida e lida por todos os homens. Evidentemente, sois uma carta de Cristo,entregue ao nosso ministério, escrita não com tinta, mas com o Espírito de Deus Vivo, não em tábuas de pedra, mas em tábuas de carne, nos corações!” (2 Cor 3.3)</strong></p><br><br>


           <p>
	         <?php date_default_timezone_set('America/Sao_Paulo');
	         Emissão : $data =date("d/m/Y");
	         echo 'Emissão : '.$data;          
             ?>
          </p>
          <p>
             Validade de trinta dias após a emissão
          </p>
          <p>
	         Congregação Sede. 
           </p>

	  	</div>
    </div>
   <hr>
    <div class="row">
	  	<div id="info_assinatura"class="col-sm-12">
	  	    <p style="font-size:12px;text-align:center;"><img id="img_ass"src="../imagens/img_carteira/assinatura.png"></p>  		
	  	    <p id="linha"style="font-size:12px;text-align:center;"> --------------------------------------------------------------------------</p>
	  	    <p id="nome_ass"style="font-size:16px;text-align:center;"> Eribaldo Mederos Coelho</p> <br><br><br>	
		    <p style="font-size:12px;margin-top:-90px;text-align:center;"> Pastor -  Presidente</p> <br><br><br>	        
           </p>
	  	</div>
    </div>

  </div>
  </div>	
<!-- -->
<footer>
   	<p style="text-align:center; ">ADTCII - Maranguape - CE | Ano <?php echo date('Y')?></p>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>









