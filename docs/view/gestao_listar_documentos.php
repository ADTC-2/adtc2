<?php   
      require_once "../db/config.php";
      $sql = "SELECT * FROM documentos";
      $sql = $pdo->query($sql);  
?>
<?php require_once'header.php';?>


<div class="conteiner">
    <div class="row">
		<div class="col-sm-2"><br><br>
			<div class="list-group"style="margin-left:5px;">
					   <a href="../view/gestao_doc_cadastro.php" class="list-group-item list-group-item-action ">
              Cadastro de Documentos Oficiais
            </a>
            <a href="../view/gestao_doc_cadastro_digitalizados.php" class="list-group-item list-group-item-action">Documentos Digitalizados</a>
            <a href="../view/gestao_listar_documentos.php" class="list-group-item list-group-item-action">Listar Documentos Modelos</a>
             <a href="../view/gestao_listar_documentos_digitalizados.php" class="list-group-item list-group-item-action">Listar Documentos Digitalizados</a>  
            	
			</div>
		</div>
		<div class="col-sm-9 float-left  bg-secondary"style="border:1px solid #000;margin-top:48px;">
             <div class="row">
<div class="col-md-12">
	<div class="table" style="overflow: auto;margin-top:10px;">
  <table class="table table-hover">
  <thead>
    <tr>
            
      <th>Id</th>
      <th>Descrição</th>
      <th>Tipo</th>
      <th>Responsavel</th>
      <th>Data Cadastro</th>
      <th>Arquivo</th>      
      <th>Ação</th>
      <th></th>
    </tr>
  </thead>
        <?php 
  
       if($sql->rowCount() > 0) {
       foreach($sql->fetchAll() as $linhas){   
        ?>
  <tbody>
            
      <td><?php echo $linhas['id'];?></td>
      <td><?php echo $linhas['descricao'];?></td>
      <td><?php echo $linhas['tipo'];?></td>      
      <td><?php echo $linhas['responsavel'];?></td>
      <td><?php echo $linhas['dataCadastro'];?></td>
      <td><?php echo $linhas['arquivo'];?></td>
      
      <td><a href="../documentos/<?php echo $linhas['arquivo'];?>" title="Baixe arquivo" download><img src="../imagens/diversas_imagens/download.png" width="20" height="20"></a></td>
      <td><a href="../procedimentos/excluir_documento.php?&id=<?php echo $linhas['id']; ?>"><img src="../imagens/diversas_imagens/excluir.png"width="30" height="20" ></a></td>
    
    </tr>
   
  </tbody>
        <?php 
           }
          } 
         ?>
</table>
</div>			
</div>

</div><!-- Linha 1 -->	

		</div>
	</div>		
</div><!-- Fim conteiner -->









<?php require 'footer.php';?>


