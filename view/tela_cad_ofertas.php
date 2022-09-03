<?php 
      require_once "../db/config.php";

      $sql = "SELECT * FROM ofertas";
      $sql = $pdo->query($sql);
	 
?>
<?php require_once'header.php';?>
<br><br><br>		
<div class="container">	
<h1>Ofertas</h1>
<hr style="border:1px solid #008000;">
<div class="row justify-content-center
"> 
<div class="col-md-4">
<form id="frmRegistro" action="../procedimentos/cadastrar_ofertas.php"  method="POST">        
	<div class="form-row">
			<div class="form-group col-md-7">			     
			      <input type="date" class="form-control" id="dataOferta" placeholder="" name="dataOferta">
			</div>
		  <div class="form-group col-md-5">			      
			      <input type="text" class="form-control" id="valor" placeholder="Valor oferta"name="valor">
		  </div>
	</div>
  
  <div class="form-row">
            <div class="form-group col-md-12">               
                <select class="form-control" id=" responsavel" name=" responsavel">   
                      
                      <option>Responsável</option>
                      <option>Maria de  Jesus</option>
                      <option>Albaniza</option>
                      <option></option>
                      <option></option>
                      <option></option>
                      <option></option>
                      <option></option>
                      <option></option>
                      <option></option>
                      <option></option>
                </select>
             </div>    
		    
    </div>

		  <button type="submit" class="btn btn-secondary">Gravar</button>
</div>
<div class="form-row">
<div class="col-md-12">
<div class="table-responsive" style="overflow: auto;margin-top:10px;">  
<table class="table table-responsive-md">
  <thead>
    <tr class="header">
      <th>Id</th>
      <th>Data</th>
      <th>Valor</th>
      <th>Responsavel</th>
       <th>Ações</th>  
     </tr>
  </thead>
  <?php 
  
  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
  <tbody>
    <tr>
      
      <td><?php echo $linhas['id_ofertas'];?></td>
      <td><?php echo date("d/m/Y",strtotime($linhas['dataOferta']));?></td>
      <td><?php echo $linhas['valor'];?></td>
      <td><?php echo $linhas['responsavel'];?></td>      
      <td><a class="btn btn-primary" href="../procedimentos/excluir_ofertas.php?&id_ofertas=<?php echo $linhas['id_ofertas']; ?>">Excluir</a></td> 
    
    </tr>
   
  </tbody>
  <?php 
       }
      } 
    ?>
</table>
</div>
    		
</div>
</div>
</div>
</div><!-- Linha 1 -->	

  
</div><!-- fim do Conteiner_principal -->
<footer style="background-color:">
	
</footer>
<?php require_once'footer.php';?>
 