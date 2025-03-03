<?php
  require 'header.php';
  require_once "../db/config.php";
          $dizimo = $_GET['dizimo'];
          $oferta = $_GET['oferta'];
          $geral = $_GET['geral'];
          $responsavel = $_GET['responsavel'];
  ?>
   
 <div class="conteiner"> 
	  <div class="row">
		<div id="frente_carteira">
        
          
          <div class="topo_comprovante">
          	  
          	  <img id="logo_comprovante" src="../imagens/img_carteira/logo sem fundo.png" alt="">
              <img id="msg_mes" src="../imagens/diversas_imagens/dizimodosenhor.jpg" alt="">
          	 

          </div>
          
          <div id="infor_corpo">
           
             <label id="label_comprovantes">Total dízimos:</label>
             <p class="font-weight-bold"id="dizimista"><?php echo $dizimo ?></p>
             <label id="label_comprovantes">Total ofertas:</label>            
             <p class="font-weight-bold"id="congregacao"><?php echo $oferta ?></p>
             <label id="label_comprovantes">Total Geral:</label> 
             <p class="font-weight-bold"id="valor"><?php echo $geral ?> </p>
             <label id="label_comprovantes">Dia:</label> 
             <p class="font-weight-bold"id="mes">
              <?php 
                date_default_timezone_set('America/Sao_Paulo');
               echo date('d/m/Y \à\s H:i:s');?>
                
             </p>
             <label id="label_comprovantes">Tesoureiro:</label> 
             <p class="font-weight-bold"id="tesoureiro"><?php echo $responsavel?> </p>


             
          </div>           	  
                           	
                  	
		 </div>
      <h4 id="letreiro_central1">COMPROVANTE ENCERRAMENTO</h4>
      <p id="nome_igreja1">ADTC II - Maranguape-CE</p>
		
    
 </div><!--Fim conteiner -->
 <nav><a class="page-link" href="#" onclick="window.print();" style="text-decoration:none;">Imprimir página</a></nav>




<?php require 'footer.php';?>