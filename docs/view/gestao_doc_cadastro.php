<?php require 'header.php';?>


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
		<div class="col-sm-9 float-left  bg-info"style="border:1px solid #ccc;margin-top:48px;padding:10px 10px; ">
                     <form id="frmRegistro" name="form1" action="../procedimentos/cadastro_doc.php"  method="post" enctype="multipart/form-data" style="border:1px solid #008000;margin-top:10px;padding:10px;margin-right:0px;background-color:#FF4500;">        
	<div class="form-row">


		  <div class="form-group col-md-6">
            Descrição			      
			      <input type="text" class="form-control" id="descricao" name="descricao">
		  </div>
          <div class="form-group col-md-2"> 
             Tipo  
            <select class="form-control" id="tipo" name="tipo">
				    <option>pdf</option>
				    <option>xls</option>
				    <option>xlsx</option>
				    <option>ppt</option>
				    <option>doc</option>
				    <option>docx</option>
				    <option>jpg</option>
				    <option>png</option>
				    <option>txt</option>
             </select>
           </div>
           <div class="form-group col-md-4">
            Responsavel			      
			      <input type="text" class="form-control" id="responsavel" name="responsavel">
		  </div>     

	</div>
  
    
     
      <div class="form-row">

      <div class="form-group col-md-12">
             
            <input type="file" id="arquivo"  name="arquivo"sty><br><br>
            <button type="submit" name="button"class="btn btn-secondary">Gravar</button>
            
      </div>
      
      
  </div>

</form>          
		</div>
	</div>		
</div><!-- Fim conteiner -->









<?php require 'footer.php';?>


