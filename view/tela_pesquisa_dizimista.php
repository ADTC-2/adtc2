<?php   
      require_once "../db/config.php";
      $sql = "SELECT * FROM filiado LIMIT 0";
      $sql = $pdo->query($sql);	 
?>
<?php require_once'header.php';?>

<div class="container">	
<h1>Controle de  Dizímos &  Ofertas</h1>
<div class="row">
    
  <ul class="nav">
      <li class="nav-item">
        <a class="nav-link active" href="../view/tela_cad_ofertas.php">Cadastrar Ofertas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../view/tela_dizimos_lancados.php">Dizimos lançados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
      </li>
  </ul>

  </div>
<hr style="border:1px solid #008000;">

	<div class="form-group input-group">
  <form class="form-group "action="../view/tela_resultado_pesquisa_dizimo.php" method="get">
  <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary" >Pesquisar</button>
  </form>
  
  </div>
   
  

	<div class="row">
   

  <div class="col-sm-4">
     <?php

      require_once "../db/config.php";
       date_default_timezone_set('America/Sao_Paulo');
       $data = date("Y-m-d");
       
       $soma_dizimo = $pdo->query("SELECT SUM(valor) AS total FROM dizimo WHERE  dataCaptura='$data'")->fetchColumn();
     
      // Imprimindo o resultado.
     ?>
         <a href="../view/tela_dizimos_lancados.php" style="text-decoration: none;"><p id="s1">Total Dízimos:  <?php echo number_format($soma_dizimo,"2"," ,"," .");; ?></p></a>
  </div>

   <div class="col-sm-4">
     <?php

      require_once "../db/config.php";
       date_default_timezone_set('America/Sao_Paulo');
       
        $soma_ofertas = $pdo->query("SELECT SUM(valor) AS total FROM ofertas WHERE dataOferta='$data'")->fetchColumn();

      // Imprimindo o resultado. 
      ?>
        <a href="../view/tela_dizimos_lancados.php" style="text-decoration: none;"><p id="s2">Total Ofertas:  <?php echo number_format($soma_ofertas,"2"," ,"," .");; ?></p></a>
   </div>

   <div class="col-sm-4">
     <?php

      require_once "../db/config.php";
       date_default_timezone_set('America/Sao_Paulo');
       
        $soma_ofertas = $pdo->query("SELECT SUM(valor) AS total FROM ofertas WHERE dataOferta='$data'")->fetchColumn();
        $soma_dizimo = $pdo->query("SELECT SUM(valor) AS total FROM dizimo WHERE  dataCaptura='$data'")->fetchColumn();
        $totalGeral = $soma_ofertas + $soma_dizimo;

      // Imprimindo o resultado. 
      ?>
        <a href="../view/tela_dizimos_lancados.php" style="text-decoration: none;"><p id="s2">Total Geral:  <?php echo number_format($totalGeral,"2"," ,"," .");; ?></p></a>
   </div>

  </div><!-- Fim linha -->
 

<div class="row">
<div class="col-md-12">
	<div class="table-responsive" style="overflow: auto;border:solid 1px #FF4500;margin-top:10px;">
       <table id="tabela" class="table table-hover">
  <thead>
    <tr>
      <th>Lançar</th>      
      <th>Matricula</th>
      <th>Nome</th>
      <th>Função</th>
      <th>Congregação</th>      
      <th>Foto</th>
      <th>Ação</th>
    </tr>
  </thead>
  <?php 
  
  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
  <tbody>
    <tr>
      <td><a href="../view/tela_lancamento_dizimo.php?&matricula=<?php echo $linhas['matricula']; ?>">Lançar</a></td>
      
     
      <td><?php echo $linhas['matricula'];?></td>
      <td><?php echo $linhas['nome'];?></td>
      <td><?php echo $linhas['funcao'];?></td>      
      <td><?php echo $linhas['congregacao'];?></td>
      <td><img src="../imagens/<?php echo $linhas['arquivo'];?>" width="100" height="100"></td>
      <td><a href="../procedimentos/excluir_filiado.php?&matricula=<?php echo $linhas['matricula']; ?>">Excluir</a></td>
    
    </tr>
   
  </tbody>
  <?php 
       }
      } 
    ?>
</table>
</div>
<div id="resultado"></div>			
</div>
  
</div><!-- Linha 1 <--><br>	<br> 


<div>
  <h1>Comprovante de Encerramento</h1>
  <hr>

  <form action="../view/tela_imprimir_comprovante_encerraento.php" method="GET">
 
  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="dizimo">Total de dízimos</label>
      <input name="dizimo"type="text" class="form-control" id="oferta">
    </div>
    <div class="form-group col-md-2">
      <label for="oferta">Total ofertas</label>
      <input name="oferta"type="text" class="form-control" id="inputCEP">
    </div>
    <div class="form-group col-md-2">
      <label for="geral">Total Geral</label>
      <input name="geral"type="text" class="form-control" id="geral">
    </div>
    <div class="form-group col-md-6">
      <label for="responsavel">Responsável</label>
      <select name="responsavel" id="responsavel" class="form-control">
        <option selected>Escolher</option>
        <option>Maria de Jesus</option>
        <option>Albaniza</option>
      </select>
    </div>
    
  </div>
  <div class="form-group">
    
  <button type="submit" class="btn btn-primary">Gerar Comprovante</button>
</form>

</div> 
<script>
$('input#txt_consulta').quicksearch('table#tabela tbody tr');
</script>





<?php require'footer.php';?>



