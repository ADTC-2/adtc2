<?php   
      require_once "../db/config.php";
       $matricula= $_GET['matricula'];
       $sql    = "SELECT * FROM filiado WHERE matricula='$matricula' ";
       $sql    = $pdo->query($sql);
?>
<?php require_once'header.php';?>


   <?php if($sql->rowCount() > 0): ?>
     <?php foreach($sql->fetchAll() as $linhas){
   ?>

      
      <div class="container">
       <div class="row">  

        <div class="cols-sm-6"id="foto_resultado">
          <img class="img-thumbnail" src="../imagens/<?php echo $linhas['arquivo'];?>" width="400" height="400" style="margin-right:20px;margin-top:40px;"> 
        </div>

        <div class="cols-sm-6" style="margin:10px 20px;margin-top:40px;">
          <label>Matricula : <?php echo $linhas['matricula'];?></label>
          <p>Nome : <?php echo $linhas['nome'];?></p>
          <p>Cargo : <?php echo $linhas['funcao'];?> </p>  
          <p>Congregação : <?php echo $linhas['congregacao'];?></p>
          <p>Documento : <?php echo $linhas['documento'];?></p>
          <p>Data de Nascimento : <?php echo date("d/m/Y",strtotime($linhas['dataNascimento']));?></p>
          <p>Data do Batismo : <?php echo date("d/m/Y",strtotime($linhas['dataBatismo']));?></p>
          <p>Estado Civil : <?php echo $linhas['estadoCivil'];?></p>  
          <p>Nome da Mãe : <?php echo $linhas['mae'];?></p>
          <p>Nome do Pai : <?php echo $linhas['pai'];?></p> 
          <p>Cadastrado em : <?php echo date("d/m/Y",strtotime($linhas['datCadastro']));?></p>
          <p>Status Atual : <?php echo $linhas['status'];?></p> 
        </div>
       
        <div class="col-sm-6" style="margin-top:20px;">
          <a class="btn btn-primary" href="../view/tela_alterar_filiado.php?&matricula=<?php echo $linhas['matricula']; ?>">Alterar</a>
        </div>
        <div class="col-sm-6" style="margin-top:20px;">
          <a class="btn btn-danger" href="../procedimentos/excluir_filiado.php?&matricula=<?php echo $linhas['matricula']; ?>">Excluir</a>
        </div>
    
      </div>    
      </div>     
     
  <?php 
    }
   ?>
<?php else: ?>
 
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/404.php'>
        <script type=\"text/javascript\">
          alert(\"Filiado não encontrado.\");
        </script>

   
<?php endif; ?>  





<?php require'footer.php';?>

 