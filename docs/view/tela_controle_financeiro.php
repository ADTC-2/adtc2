<?php 
  
  require '../db/config.php';
  require_once'header.php';
?>
<?php 
  $tipo_entrada  = $_GET['tipo_entrada'];
  $congregacao   = $_GET['congregacao'];
  $valor         = $_GET['valor'];
  $nome          = $_GET['nome'];



?>


<div class="container" style="border:1px solid #000;width:1024px;height:600px;margin-top:60px;"><br>	
   
  <form action="../view/tela_controle_financeiro.php" method="GET">
  <div class="row">
  <div class="col-sm-12">
    <label for="tipo_entrada">Tipo de Entrada</label>
    <select name="tipo_entrada" class="form-control" id="tipo_entrada">
      <option>Selecione</option>
      <option>Dizimo</option>
      <option>Oferta</option>
      <option>Voto</option>
      <option>Prestação de Contas</option>
      <option>Outros</option>
    </select>
  </div>
  </div>  
  
  <div class="row">
  <div class="col-sm-12">
    <label for="congregacao">Congregação</label>
    <select name="congregacao" class="form-control" id="congregacao">
      <option>Selecione</option>
      <option>Sede</option>
      
    </select>
  </div>
  </div>  
  
  <div class="row">
  <div class="col-sm-12">
    <label for="valor">Valor</label>
    <input name="valor" type="text" class="form-control" id="valor" placeholder="">
  </div>
  </div>

  <div class="row">
  <div class="col-sm-12">
    <label for="nome">Nome</label>
    <input name="nome" type="text" class="form-control" id="nome" placeholder="">
  </div>
  </div>
 
 <input type="submit" value="Gravar">
  

</form>

  <div>
  <hr>  
  
    <?php
     echo 'Nome : '.$nome;
    ?>
  <hr>
    
    <?php
     echo 'Entrada :'.$tipo_entrada;
    ?>
    <hr>
    
    <?php
     echo 'Valor :'.$valor;
    ?>

  </div>

</div><!-- fim do Conteiner_principal -->


<?php require'footer.php';?>
<script>

  $(document).ready(function(){
    $('#registro').click(function(){

      vazios=validarFormVazio('frmRegistro');

      if(vazios > 0){
        alert("Preencha os Campos!!");
        return false;
      }

      

</script>


