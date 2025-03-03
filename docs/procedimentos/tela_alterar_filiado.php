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
<h1>Cadastrar Novo Filiado</h1>
<hr style="border:1px solid #008000;">

<div class="row">
<div class="col-md-12">	
<form id="frmRegistro" name="form1" action="..procedimentos/alterar_filiado.php"  method="POST" enctype="multipart/form-data" style="border:1px solid #008000;margin-top:10px;padding:10px;margin-right:0px;background-color:#FF4500;">
       
	<div class="form-row">
      
      <div class="col-md-3">
           
           <h1>Alterar Filiado</h1>
           <input class="form-control" type="hidden"  name="matricula"  value="<?php echo $resultado['matricula']?>">  
      </div> 
      <div class="col-md-9">            
          <img src="../imagens/<?php echo $resultado['arquivo'];?>" width="100" height="100">
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
            <label for="funcao" id="label_cor">Função </label>              
            <select class="form-control" id="funcao" name="funcao">   
                      
                      <option><?php echo $resultado['funcao']?></option>
                      <option>Novo Convertido</option>
                      <option>Congregado</option>
                      <option>Membro</option>
                      <option>Auxiliar</option>
                      <option>Diácono</option>
                      <option>Presbítero</option>
                      <option>Evangelista</option>
                      <option>Missionário</option>
                      <option>Pastor-Presidente</option>
                      <option>Co-Pastor</option>
                      <option>Pastor</option>
                </select>
      </div>
      

	</div>
  
    <div class="form-row">
            <div class="form-group col-md-6"> 
                <label for="congregacao" id="label_cor">Congregação</label>               
                <select class="form-control" id="congregacao" name="congregacao">                   
                      <option><?php echo $resultado['congregacao']?></option>
                      <option>SEDE</option>
                      <option>ALEGRIA</option>
                      <option>JUBAIA</option>
                      <option>LAGES</option>
                      <option>NOVO MARANGUAPE 1</option>
                      <option>NOVO MARANGUAPE 2</option>
                      <option>NOVO MARANGUAPE 3</option>
                      <option>PLANALTO</option>
                      <option>OUTRA BANDA</option>
                      <option>PARQUE SÃO JOÃO</option>
                      <option>NOVO PARQUE IRACEMA</option>
                      <option>SITIO SÃO LUIZ</option>
                      <option>TABATINGA</option>
                      <option>UMARIZEIRAS</option>
                      <option>VITÓRIA</option>
                      <option>VIÇOSA</option>
                      
                      
                </select>
             </div>

		    <div class="form-group col-md-2" >
                <label for="documento" id="label_cor">Documento</label> 		       	      
                <input type="text" class="form-control" id="documento"placeholder=""name="documento" value="<?php echo $resultado['documento']?>">
		    </div>
        <div class="form-group col-md-2" >
                <label for="datanascimento" id="label_cor">Data Nascimento</label>                  
                <input type="text" class="form-control" id="dataNascimento"placeholder="00/00/0000"name="dataNascimento" value="<?php echo date("d/m/Y",strtotime($linhas['dataNascimento']))?>">
        </div>
        <div class="form-group col-md-2" >
                <label for="databatismo" id="label_cor">Data Batismo</label>                   
                <input type="text" class="form-control" id="dataBatismo"placeholder="00/00/0000"name="dataBatismo" value="<?php echo date("d/m/Y",strtotime($linhas['dataBatismo']))?>">
        </div>
		    
    </div>

    <div class="form-row">

      <div class="form-group col-md-2" >
            <label for="estadoCivil" id="label_cor">Estado Civil</label>       
            <select class="form-control" id="estadoCivil" name="estadoCivil">   
                      
                      <option><?php echo $resultado['estadoCivil']?></option>
                      <option>Casado</option>
                      <option>Casada</option>
                      <option>Solteiro</option>
                      <option>Solteira</option>
                      <option>Divorciado</option>
                      <option>Divorciada</option>
                      <option>Viuvo</option>
                      <option>Viuva</option>
                      <option>Separado</option>
                      <option>Separada</option>
                </select>
      </div>
      <div class="form-group col-md-5" id="label_cor">
           <label for="mae" id="label_cor"> Nome da Mãe</label>             
            <input type="text" class="form-control" id="mae" name="mae"onkeyup="maiuscula(this)"value="<?php echo $resultado['mae']?>">
      </div>
      <div class="form-group col-md-5" id="label_cor"> 
             <label for="pai" id="label_cor">Nome do Pai </label>   
            <input type="text" class="form-control" id="pai"  name="pai"onkeyup="maiuscula(this)"value="<?php echo $resultado['pai']?>">
      </div>
    </div>  
    <div class="form-row">             
        
        <div class="form-group col-md-2" id="label_cor">
                <label for="datCadastro" id="label_cor">Data do Cadastro</label>                   
                <input type="text" class="form-control" id="datCadastro"placeholder="00/00/0000"name="datCadastro" onkeyup="maiuscula(this)"value="<?php echo date("d/m/Y",strtotime($resultado['datCadastro']))?>">
        </div>  
    </div>
    <!---  Formulario para adicionar endereço                               -->
    <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="logradouro" id="label_cor">Logradouro</label>               
                <select class="form-control" id="logradouro" name="logradouro">   
                      
                      <option><?php echo $resultado['logradouro']?></option>
                      <option>Rua</option>
                      <option>Avenida</option>
                      <option>Fazenda</option>
                      <option>Rodovia</option>
                      <option>Travessa</option>
                      <option>Povoado</option>
                      <option>Distrito</option>
                </select>
             </div>

        <div class="form-group col-md-6" >
                <label for="endereco" id="label_cor">Endereço</label>                
                <input type="text" class="form-control" id="endereco"placeholder=""name="endereco" onkeyup="maiuscula(this)"value="<?php echo $resultado['endereco']?>">
        </div>
        <div class="form-group col-md-2" >
                <label for="numero" id="label_cor">Numero</label>                  
                <input type="text" class="form-control" id="numero"placeholder=""name="numero" value="<?php echo $resultado['numero']?>">
        </div>
        <div class="form-group col-md-2" >
                <label for="bairro" id="label_cor">Bairro</label>                   
                <input type="text" class="form-control" id="bairro"placeholder=""name="bairro" onkeyup="maiuscula(this)"value="<?php echo $resultado['bairro']?>">
        </div>
        
    </div>
    <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="cep" id="label_cor">CEP</label>               
                <input type="text" class="form-control" id="cep"placeholder=""name="cep" value="<?php echo $resultado['cep']?>">
             </div>

        <div class="form-group col-md-2" >
                <label for="cidade" id="label_cor">Cidade</label>                   
                <input type="text" class="form-control" id="cidade"placeholder=""name="cidade" onkeyup="maiuscula(this)"value="<?php echo $resultado['cidade']?>">
        </div>
        <div class="form-group col-md-2" >
                <label for="uf" id="label_cor">UF</label>                  
                <select class="form-control" id="uf" name="uf">                   
                      <option><?php echo $resultado['uf']?></option>
                      <option>AC</option>
                      <option>AL</option>
                      <option>AM</option>
                      <option>AP</option>
                      <option>BA</option>
                      <option>CE</option>
                      <option>DF</option>
                </select>
            
        </div>
        <div class="form-group col-md-2" >
                <label for="telefone" id="label_cor">Telefone</label>                   
                <input type="text" class="form-control" id="telefone"placeholder="(99)99999-9999"name="telefone" value="<?php echo $resultado['telefone']?>">
        </div>
        <div class="form-group col-md-4" >
                <label for="email" id="label_cor">E-mail</label>                   
                <input type="text" class="form-control" id="email"placeholder="xxx@xx.com"name="email" value="<?php echo $resultado['email']?>">
        </div>
        
    </div>
    <div class="form-group col-md-12" id="label_cor"> 
             
            <div class="form-group">
                <label for="arquivo"><?php echo $resultado['arquivo'];?></label>
                <input type="file" class="form-control-file" id="arquivo" name="arquivo">
            </div>

    </div>
      <button id="registro" type="submit" name="button"class="btn btn-secondary">Alterar</button>
     
    
      
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