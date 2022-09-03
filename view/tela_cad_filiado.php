<?php   
  require '../db/config.php';
  require_once'header.php';
?>
<div class="container">	
<h1>Cadastrar Novo Filiado</h1>
<hr style="border:1px solid #008000;">
 <a href="../view/tela_controle_filiado.php">Listar filiados</a>
<div class="row">
<div class="col-md-12">	
<form id="frmRegistro" name="frmRegistro" action="../procedimentos/cadastrar_filiado.php"  method="POST" enctype="multipart/form-data" style="border:1px solid #008000;margin-top:10px;padding:10px;margin-right:0px;background-color:#FF4500;">
       
	<div class="form-row">
      
      <div class="col-md-6">
           
             
      </div> 
      <div class="col-md-6">            
          
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
			      <input type="text" class="form-control"  name="nome"onkeyup="maiuscula(this)"required name=nome>
		  </div>
      <div class="form-group col-md-4"> 
            <label for="funcao" id="label_cor">Função </label>              
            <select class="form-control" id="funcao" name="funcao"onkeyup="maiuscula(this)"required name=funcao>   
                      
                      <option>Selecione</option>
                      <option>Novo Convertido</option>
                      <option>Membro</option>
                      <option>Congregado</option>
                      <option>Auxiliar</option>
                      <option>Diácono</option>
                      <option>Presbítero</option>
                      <option>Evangelista</option>
                      <option>Missionário</option>
                      <option>Pastor-Presidente</option>
                      <option>Co-Pastor</option>
                      <option>Pastor</option>
                      <option>Supervisor de Congregação</option>
                      <option>Musico</option>
                </select>
      </div>
      

	</div>
  
    <div class="form-row">
            <div class="form-group col-md-4"> 
            <label for="congregacao" id="label_cor">Congregação</label>      <select class="form-control" id="congregacao" name="congregacao"onkeyup="maiuscula(this)"required name=congregacao>                   
                      <option>Selecione</option>
                      <option>SEDE</option>
                      <option>ALEGRIA</option>
                      <option>JUBAIA</option>
                      <option>LAGES</option>
                      <option>NOVO MARANGUAPE 1</option>
                      <option>NOVO MARANGUAPE 2</option>
                      <option>NOVO MARANGUAPE 3</option>
                      <option>NOVO MARANGUAPE 4</option>                     
                      <option>OUTRA BANDA</option>
                      <option>PARQUE SÃO JOÃO</option>
                      <option>NOVO PARQUE IRACEMA</option>
                      <option>SITIO SÃO LUIZ</option>
                      <option>TABATINGA</option>
                      <option>UMARIZEIRAS</option>
                      <option>VITÓRIA</option>
                      <option>VIÇOSA</option>
                      <option>PAPARA</option>
                      <option>PLANALTO</option>
                      <option>SERRA JUBAIA</option>
                      <option>IRACEMA</option>
                      <option>PARAISO</option>
                      <option>CASTELO</option>
                      <option>Lameirão</option>
                      
                </select>
             </div>

		    <div class="form-group col-md-2" >
                <label for="documento" id="label_cor">Documento</label> 		       	      
                <input type="text" class="form-control" id="documento"placeholder=""name="documento" >
		    </div>
        <div class="form-group col-md-3" >
                <label for="datanascimento" id="label_cor">Data Nascimento</label>                  
                <input type="date" class="form-control" id="dataNascimento"name="dataNascimento" >
        </div>
        <div class="form-group col-md-3" >
                <label for="databatismo" id="label_cor">Data Batismo</label>                   
                <input type="date" class="form-control" id="dataBatismo"name="dataBatismo" >
        </div>
		    
    </div>

    <div class="form-row">

      <div class="form-group col-md-2" >
            <label for="estadoCivil" id="label_cor">Estado Civil</label>       
            <select class="form-control" id="estadoCivil" name="estadoCivil" onkeyup="maiuscula(this)"required name=estadoCivil>   
                      
                      <option>Selecione</option>
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
            <input type="text" class="form-control" id="mae" name="mae"onkeyup="maiuscula(this)">
      </div>
      <div class="form-group col-md-5" id="label_cor"> 
             <label for="pai" id="label_cor">Nome do Pai </label>   
            <input type="text" class="form-control" id="pai"  name="pai"onkeyup="maiuscula(this)">
      </div>
    </div>  
    <div class="form-row">             
        <div class="form-group col-md-12" id="label_cor"> 
             <label for="arquivo" id="label_cor">Cadastrar imagem</label>   
            <input type="file" class="form-control" id="arquivo"  name="arquivo"required name=arquivo>
        </div>
          
    </div>
    <!---  Formulario para adicionar endereço                               -->
    <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="logradouro" id="label_cor">Logradouro</label>               
                <select class="form-control" id="logradouro" name="logradouro">   
                      
                      <option>Selecione</option>
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
                <input type="text" class="form-control" id="endereco"placeholder=""name="endereco" onkeyup="maiuscula(this)">
        </div>
        <div class="form-group col-md-2" >
                <label for="numero" id="label_cor">Numero</label>                  
                <input type="text" class="form-control" id="numero"placeholder=""name="numero" >
        </div>
        <div class="form-group col-md-2" >
                <label for="bairro" id="label_cor">Bairro</label>                   
                <input type="text" class="form-control" id="bairro"placeholder=""name="bairro" onkeyup="maiuscula(this)">
        </div>
        
    </div>
    <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="cep" id="label_cor">CEP</label>               
                <input type="text" class="form-control" id="cep"placeholder="99.999-999"name="cep" >
             </div>

        <div class="form-group col-md-2" >
                <label for="cidade" id="label_cor">Cidade</label>                   
                <input type="text" class="form-control" id="cidade"placeholder=""name="cidade" onkeyup="maiuscula(this)"required name=cidade>
        </div>
        <div class="form-group col-md-2" >
                <label for="uf" id="label_cor">UF</label>                  
                <select class="form-control" id="uf" name="uf"required name=uf>                   
                      <option>Selecione</option>
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
                <input type="text" class="form-control" id="telefone"placeholder="(99)99999-9999"name="telefone" required name=telefone>
        </div>
        <div class="form-group col-md-4" >
                <label for="email" id="label_cor">E-mail</label>                   
                <input type="text" class="form-control" id="email"placeholder="xxx@xx.com"name="email" >
        </div>
        <div class="form-group col-md-2" >
                <label for="status" id="label_cor">Status</label>   
                <select class="form-control" id="status" name="status"required name=status>         
                      <option><?php echo $resultado['status']?></option>
                      <option>Ativo</option>
                      <option>Habilitado ao Batismo</option>
                      <option>Em discipulado</option>
                      <option>Falecido</option>
                      <option>Deixou Ministerio</option>
                      <option>Em disciplina</option>
                      <option>Mudança ADTC2</option>
                </select>
        </div>
        
    </div>
      <button id="registro" type="submit" name="button"class="btn btn-secondary"onclick="">Gravar</button>
    </div>

</form>          
</div>
</div><!-- fim do Conteiner_principal -->


<?php require'footer.php';?>



