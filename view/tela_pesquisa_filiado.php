<?php   
      require_once "../db/config.php";
      $sql = "SELECT * FROM filiado  LIMIT 0";
      $sql = $pdo->query($sql);	 
?>
<?php require_once'header.php';?>

<div class="container">	
<h1>Controle Geral</h1>
<hr style="border:1px solid #008000;">

<div class="col-sm-8 form-group ">
  <form class="form-group "action="../view/tela_resultado_pesquisa_filiado.php" method="get">
  <input name="matricula" id="txt_consulta" placeholder="Digite a Matricula do Filiado" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
  </div>
      


<?php require'footer.php';?>

 