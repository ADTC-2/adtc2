<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('Location: ../login.php');
    exit();
}
// Verifica se os parâmetros estão definidos e atribui às variáveis locais
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$funcao = isset($_GET['funcao']) ? $_GET['funcao'] : '';
$estadocivil = isset($_GET['estadocivil']) ? $_GET['estadocivil'] : '';
$cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' href='carta.css'>
    <link rel='stylesheet' href='../css/meuEstilo.configuracao_impressao.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />    
    <title>Emissão de Carta</title> 
            <style>
        @media print {
            #myNav,#fas {
                display: none;
            }   
        @page {
                size: A4;
                margin: 0;
            }   
        }
    </style>    
  </head>

  <body><!-- -->
  <div class="container">

    <div class="row">
    <img id= "fundo_carta_novo"  src="../imagens/img_carteira/modelo_carta.png" alt="">
 	
   
    <div class="row">
	  	<div id="info_cabecalho">
	  		<b>Nome : <?php echo $nome ;?></b><br>	  		
	  	<b>Cargo : <?php echo $funcao ;?></b><br> 
	  		<b>Estado Civil : <?php echo $estadocivil ;?></b><br>
	  		<b>Cidade de destino : <?php echo $cidade;?></b><br>
	  	</div>  
    </div>
   
    <div class="row">
	  	<div id="info_tipocarta1">	  		
               <input type="checkbox" value=""id="check">
     	</div>
    </div>
    <div class="row">
	  	<div id="info_tipocarta2">	  	
               <input type="checkbox" value=""id="check">
     	</div>
    </div>
    <div class="row">
	  	<div id="info_tipocarta3">	
               <input type="checkbox" value=""id="check">
     	</div>
    </div>
   
	<div class="row">
	  	<div id="info_texto"> 		  	
		    <p> Saudações no Senhor</p> <br><br><br>		
	      <p>Por se achar em pleno gozo e comunhão, nós o (a) recomendamos para que recebais no Senhor como se usa fazer os santos.
	        Pela <b>Igreja Evangélica Assembléia de Deus Templo Central II</b>. Localizada a Rua Coronel Antônio Botelho - Parque Santa Fé - Maranguape - CE.</p> <br><br><br>
        </p>
	      <p><strong>“Nossa carta sóis vós, carta escrita em nossos corações, reconhecida e lida por todos os homens. Evidentemente, sois uma carta de Cristo,entregue ao nosso ministério, escrita não com tinta, mas com o Espírito de Deus Vivo, não em tábuas de pedra, mas em tábuas de carne, nos corações!” (2 Cor 3.3)</strong></p><br><br>
        <p>
	      <?php date_default_timezone_set('America/Sao_Paulo');
                $date = new DateTime();
                 $formatter = new IntlDateFormatter(
                   'pt_BR',
                    IntlDateFormatter::FULL,
                    IntlDateFormatter::NONE,
                    'America/Sao_Paulo',          
                    IntlDateFormatter::GREGORIAN
                  );
                  echo $formatter->format($date);         
         ?>
       </p>
          <p>
             <b>Validade de trinta dias após a emissão</b>
          </p>
          <p>
	        
           </p>

	  	</div>
    </div>
  
    <div class="row">
	  	<div id="info_assinatura"class="col-sm-12">
	  	 <img id="img_ass"src="../imagens/img_carteira/assinatura.png">           
	  	</div>
    </div>

   <div class="row">
    <div id= "nomeDaAssinatura">           
      <p style="font-size:16px;text-align:center;"> Eribaldo Mederos Coelho</p> <br><br><br>			 
    </div>  
   </div> 

   <div class="row">
    <div id= "nomeDaAssinatura1">           
      <p style="font-size:12px;text-align:center;"> Pastor Presidente</p> <br><br><br>			 
    </div>  
   </div> 

  </div>
  </div>	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>









