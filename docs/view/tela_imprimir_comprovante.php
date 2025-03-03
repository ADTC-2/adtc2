<?php
  require 'header.php';
  require_once "../db/config.php";

      $sql="SELECT * FROM dizimo ";
      $sql=$pdo->query($sql);

    	 	   $id_dizimo = $_GET['id_dizimo'];
     
      $sql = "SELECT * FROM dizimo WHERE id_dizimo ='$id_dizimo' LIMIT 1";
      $sql = $pdo->query($sql);	 
    
     

  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
   
 <div class="conteiner"> 
	  <div class="row">
		<div id="frente_carteira">
        
          
          <div class="topo_comprovante">
          	  
          	  <img id="logo_comprovante" src="../imagens/img_carteira/logo sem fundo.png" alt="">
              <img id="msg_mes" src="../imagens/diversas_imagens/dizimodosenhor.jpg" alt="">
          	 

          </div>
          
          <div id="infor_corpo">
           
             <label id="label_comprovantes">Dizimista:</label>
             <p class="font-weight-bold"id="dizimista"><?php echo $linhas['nome'];?></p>
             <label id="label_comprovantes">Congregação:</label>            
             <p class="font-weight-bold"id="congregacao"><?php echo $linhas['congregacao'];?></p>
             <label id="label_comprovantes">Valor:</label> 
             <p class="font-weight-bold"id="valor">  <?php echo $linhas['valor'];?>,00</p>
             <label id="label_comprovantes">Mês:</label> 
             <p class="font-weight-bold"id="mes">  <?php echo date('m/Y',strtotime($linhas['dataCaptura']));?></p>
             <label id="label_comprovantes">Tesoureiro:</label> 
             <p class="font-weight-bold"id="tesoureiro">  <?php echo $linhas['responsavel'];?></p>


             
          </div>           	  
                           	
                  	
		 </div>
      <h4 id="letreiro_central">COMPROVANTE DÍZIMO</h4>
      <p id="nome_igreja">ADTC II - Maranguape-CE</p>
		
    
 </div><!--Fim conteiner -->
 <nav><a class="page-link" href="#" onclick="window.print();" style="text-decoration:none;">Imprimir página</a></nav>

<?php 
       }
      } 
    ?>



<?php require 'footer.php';?>