<?php
  require 'header.php';
  require_once "../db/config.php";

      $sql="SELECT * FROM filiado ";
      $sql=$pdo->query($sql);

    	 	   $matricula = $_GET['matricula'];
     
      $sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
      $sql = $pdo->query($sql);	 
    
     

  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
   <nav aria-label="Page navigation example">
            <ul class="pagination">
            
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_carteira_modelo2.php?&matricula=<?php echo $linhas['matricula']; ?>">Obreiro</a></li>
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_carteira_modelo3.php?&matricula=<?php echo $linhas['matricula']; ?>">Membro</a></li>
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_carteira_modelo4.php?&matricula=<?php echo $linhas['matricula']; ?>">Congregado</a></li>
           
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_envelope.php?&matricula=<?php echo $linhas['matricula']; ?>">Envelope de Dizimo</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="window.print();" style="text-decoration:none;">Imprimir página</a></li>
          </ul>
      </nav>
 <div class="conteiner">
 
	  <div class="row">
		<div id="frente_carteira_envelope">
        
     
          	  
          	  <img id="logo_env" src="../imagens/diversas_imagens/logoNovo.jpg" alt="">
          	

        
          
          <div id="corpo_env">
           
             
             <p class="font-weight-bold"id="dados_frente_env" style="text-align:center; "><?php echo $linhas['nome'];?></p>
              <p class="font-weight-bold"id="dados_frente_env1" style="text-align:center; "><?php echo $linhas['congregacao'];?></p>
            
             
          </div>           	  
                           	
                  	
		 </div>
      <h4 id="cab_cartao_env">ENVELOPE DE DÍZIMO</h4>
     <img id="foto_carteira_env"src="../imagens/<?php echo $linhas['arquivo'];?>" width="120" height="150" style="border-radius:600px;">

		 

		</div>
     
      
	  </div><!--Fim linha 1 -->
        
    
 </div><!--Fim conteiner -->


<?php 
       }
      } 
    ?>



<?php require 'footer.php';?>