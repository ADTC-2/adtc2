<?php   
      require_once "../db/config.php";
       $consulta = $_GET['consulta'];
       $sql    = "SELECT * FROM dizimo WHERE nome LIKE '$consulta%'";
       $sql    = $pdo->query($sql);
?>
<?php require_once'header.php';?>

<div class="container"> 
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
<h1>Controle de  Dizímos</h1>
<hr style="border:1px solid #008000;">

  <div class="form-group input-group">
  <form class="form-group "action="../view/tela_resultado_pesquisa_dizimo_lancados.php" method="get">
  <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
  </div>
      
  


<div class="row">
<div class="col-md-12">
  <div class="table-responsive" style="overflow: auto;border:solid 1px #FF4500;margin-top:10px;">
       <table id="tabela" class="table table-hover">
  <thead>
    <tr>
     
      <th></th>
      <th>Movimentação</th>      
      <th>Nome</th>      
      <th>Congregação</th>      
      <th>Valor</th>
      <th>Responsavel</th>
      <th>Lançamento em:</th>
    </tr>
  </thead>
  <?php 
  
  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
  <tbody>
    <tr>
   
      <td><a href="https://tc2maranguape.com.br/sistema/view/tela_imprimir_comprovante.php?&id_dizimo=<?php echo $linhas['id_dizimo']; ?>">Comprovante</a></td>
     
      <td><?php echo $linhas['id_dizimo'];?></td>
      <td><?php echo $linhas['nome'];?></td>
      <td><?php echo $linhas['congregacao'];?></td>      
      <td><?php echo $linhas['valor'];?></td>
      <td><?php echo $linhas['responsavel'];?></td>
      <td><?php echo $linhas['dataCaptura'];?></td>
      
    
    </tr>
   
  </tbody>
  <?php 
       }
      } 
    ?>
</table>
</div>      
</div>
  
</div><!-- Linha 1 <--><br> <br>  
<script>
$('input#txt_consulta').quicksearch('table#tabela tbody tr');
</script>

</div><!-- fim do Conteiner_principal -->>

<?php require'footer.php';?>

 