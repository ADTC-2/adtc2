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
  <?php

  ?>
  <div class="container">
  <div class="row">
   <nav aria-label="Page navigation example">
            <ul class="pagination">
            
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_carteira_modelo2.php?&matricula=<?php echo $linhas['matricula']; ?>">Obreiro</a></li>
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_carteira_modelo3.php?&matricula=<?php echo $linhas['matricula']; ?>">Membro</a></li>
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_carteira_modelo4.php?&matricula=<?php echo $linhas['matricula']; ?>">Congregado</a></li>           
            <li class="page-item"><a class="page-link" href="../view/tela_imprimir_envelope.php?&matricula=<?php echo $linhas['matricula']; ?>">Envelope de Dizimo</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="window.print();" style="text-decoration:none;">Imprimir página</a></li>
          </ul>
      </nav>
 </div>
 </div>     
 <div class="conteiner"> 
	  <div class="row">
		<div id="frente_carteira">
        
     
          <div class="topo">
          	  <img id="fundo" src="../imagens/img_carteira/novorosa.jpg" alt="">
          	  <img id="logo" src="../imagens/img_carteira/logo sem fundo.png" alt="">
          	  <img id="texto_topo" src="../imagens/img_carteira/texto_topo.png" alt="">
          </div>
          
          <div id="corpo">
           
             <p class="font-weight-bold"id="dados_frente">Matricula: <?php echo $matricula;?></p>
             <p class="font-weight-bold"id="dados_frente">Nome:  <?php echo $linhas['nome'];?></p>
             <p class="font-weight-bold"id="dados_frente">Cargo:  <?php echo $linhas['funcao'];?></p>
             <p class="font-weight-bold"id="dados_frente">Congregação:  <?php echo $linhas['congregacao'];?></p>
             <p id="endereco1"><strong>Rua Ceronel Antônio Botelho, S/N.Parque Santa Fé-Maranguape-Ce</strong></p>
          </div>           	  
                           	
                  	
		 </div>
      <h4 id="cab_maranata">CONJUNTO MARANATA - 30 ANOS</h4>
      <h4 id="cab_cartao1">PÉROLA VALIOSA</h4>
     <img id="foto_carteira"src="../imagens/<?php echo $linhas['arquivo'];?>" width="120" height="150" style="border-radius:10px;">

		<div id="verso_carteira">	  	
         <img id="fundo_verso" src="../imagens/img_carteira/novorosa.jpg" alt="">
        <div id="corpo_verso">
                         
             <p class="font-weight-bold"id="dados_verso"><label id="tex_documento">Documento:</label>&nbsp;<?php echo $linhas['documento'];?>
              <label id="tex_nascimento">Nascimento:</label>&nbsp;
              <?php echo date("d/m/Y",strtotime($linhas['dataNascimento']));?></p>
             <p class="font-weight-bold"id="dados_verso"><label id="tex_batizado">Batizado em:&nbsp;</label><?php echo date("d/m/Y",strtotime($linhas['dataBatismo']));?>
              <label id="tex_estadocivil">Estado Civil:</label>&nbsp;<?php echo $linhas['estadoCivil'];?></p>
             <p class="font-weight-bold"id="dados_verso"><label id="tex_mae">Mãe:</label>&nbsp;<?php echo $linhas['mae'];?></p>
             <p class="font-weight-bold"id="dados_verso"><label id="tex_pai">Pai:</label>&nbsp;<?php echo $linhas['pai'];?></p>
          </div>
                
         <p class="central">
          A Constituição Federal assegura a qualquer cidadão o direito a livre manifestação de pensamento,   
         á liberdade de crença ,ao livre exercicio de cultos religiosos,
         sendo o seu local e liturgia protegidos e a prestação assistência reliciosa nas instituições de internamento.CRRB/1988,art 5º,IV,VI,VII e VIII.Capitulo 1º,Art 5. CONSTITUIÇÃO FEDERAL
         <br>
         Esta credencial é nominal e intransferivel.O titular somente poderá porta-lá
         enquanto proceder conforme os principios da palavra de Deus.
        </p>

          <img  id="assinatura" src="../imagens/img_carteira/assinatura.png"/>  
          <div id="assinatura_imagem">       
                 
          <p id="dados_verso1">-------------------------------------------------------</strong></p> 
          <p id="dados_verso2">Pastor Presidente - <strong>Eribaldo Medeiros Coelho </strong></p>     
   </div> 

		</div>
     
     
      
	  </div><!--Fim linha 1 -->
 
     
    
 </div><!--Fim conteiner -->


<?php 
       }
      } 
    ?>



<?php require 'footer.php';?>