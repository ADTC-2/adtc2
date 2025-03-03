<?php   
      require_once "../db/config.php";
      $sql = "SELECT * FROM filiado  LIMIT 0";
      $sql = $pdo->query($sql);	 
?>
<?php require_once'header.php';?>

<div class="container">
<br>
<h1>CARTÃO DE IDENTIFICAÇÃO</h1>  
<div>
  <img src="../imagens/diversas_imagens/cartao-de-credito.png" width="400" height="250">
</div>
<br>

<hr>
<div class="col-sm-4 form-group ">
  <form class="form-group "action="../view/tela_imprimir_carteira_princiapal.php" method="get">
      <input name="matricula" id="txt_consulta" placeholder="Pesquisar pela Matricula" type="text" class="form-control"><br>
      <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
</div>
<div class="col-sm-4 form-group ">
  <form class="form-group "action="../view/tela_imprimir_carteira_princiapal_nome.php" method="get">
      <input name="nome" id="txt_consulta" placeholder="Pesquisar pela Nome" type="text" class="form-control"><br>
      <button type="submit" class="form-group btn btn-success">Pesquisar</button>
  </form>
</div>

<?php require'footer.php';?>

 