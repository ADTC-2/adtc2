<?php require_once'header.php';?>
<?php 
  require '../db/config.php';

 $sql="SELECT * FROM filiado ";
 $sql=$pdo->query($sql);

  $matricula = $_GET['matricula'];

  $sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
  $sql=$pdo->query($sql);
  if ($sql->rowCount() > 0) {
    # code...
   foreach ($sql->fetchAll() as $resultado) {
     # code...
   }

  }


?>


<div class="container">	
<h1>Lançar Dízimos</h1>
<hr style="border:1px solid #008000;">
<div class="form-group col-md-12" id="label_cor"> 
             

        </div>
<div class="row">
<div class="col-md-12">	
<form id="frmRegistro" name="form1" action="https://tc2maranguape.com.br/sistema/procedimentos/cadastrar_dizimo.php"  method="POST" enctype="multipart/form-data" style="border:1px solid #008000;margin-top:10px;padding:10px;margin-right:0px;background-color:#FF4500;">
       
	<div class="form-row">
      
      <div class="col-md-3">
           
           <h1>Sou Dízimista</h1>
           <input class="form-control" type="hidden"  name="matricula"  value="<?php echo $resultado['matricula']?>">  
      </div> 
      <div class="col-md-9">            
          <img src="https://tc2maranguape.com.br/sistema/imagens/<?php echo $resultado['arquivo'];?>" width="100" height="100">
      </div>
            <script type="text/javascript">
          // INICIO FUNÇÃO DE MASCARA MAIUSCULA
          function maiuscula(z){
                  v = z.value.toUpperCase();
                  z.value = v;
              }
          //FIM DA FUNÇÃO MASCARA MAIUSCULA
          </script>
		  <div class="form-group col-md-8">
            <label for="nome" id="label_cor">Nome</label>			      
			      <input type="text" class="form-control" id="" name="nome"onkeyup="maiuscula(this)" value="<?php echo $resultado['nome']?>">
		  </div>
      <div class="form-group col-md-4"> 
                <label for="congregacao" id="label_cor">Congregação</label>               
                <select class="form-control" id="congregacao" name="congregacao">                   
                      <option><?php echo $resultado['congregacao']?></option>
                      <option>ALEGRIA</option>
                      <option>JUBAIA</option>
                      <option>LAGES</option>
                      <option>NOVO MARANGUAPE 1</option>
                      <option>NOVO MARANGUAPE 2</option>
                      <option>NOVO MARANGUAPE 3</option>
                      <option>NOVO MARANGUAPE 4</option>
                      <option>OUTRA BANDA</option>
                      <option>PARQUE SÃO JOÃO</option>
                      <option>PARQUE IRACEMA</option>
                      <option>SITIO SÃO LUIZ</option>
                      <option>TABATINGA</option>
                      <option>UMARIZEIRAS</option>
                      <option>VITÓRIA</option>
                      <option>VIÇOSA</option>
                      <option></option>
                      
                </select>
             </div>
      

	</div>
  
    
    
    <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="valor" id="label_cor">VALOR</label>               
                <input type="text" class="form-control" id="valor"placeholder=""name="valor" >
             </div>

        <div class="form-group col-md-2" >
                <label for="cidade" id="label_cor">Responsável</label>                   
                <select class="form-control" id="responsavel" name="responsavel">                   
                      <option>RESPONSAVEL</option>
                      <option>MARIA DE JESUS</option>
                      <option>ALBANIZA</option>
                      <option></option>
                      <option></option>
                      <option></option>                      
                      <option></option>
                      
                </select>
        </div>
        
        
    </div>
   
      <button id="registro" type="submit" name="button"class="btn btn-secondary">Gravar</button>
     
    
      
  </div>

</form>          
</div>




</div><!-- fim do Conteiner_principal -->
     

<?php require'footer.php';?>




<script type="text/javascript">
  $(document).ready(function(){
    $('#registro').click(function(){

      vazios=validarFormVazio('frmRegistro');

      if(vazios > 0){
        alert("Preencha os Campos!!");
        return false;
      }

      


</script>