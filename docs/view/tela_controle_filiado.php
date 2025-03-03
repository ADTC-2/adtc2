<?php require_once'header.php';?>

<div class="container"> 
<h1>Consultar Filiados</h1>
<hr style="border:1px solid #008000;">

  <div class="col-sm-8">
  <form class="form-group "action="../view/tela_resultado_pesquisa_filiado.php" method="get">
  <input name="matricula" id="txt_consulta" placeholder="Digite a Matricula  do Filiado" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
  </div>
  <hr>
  <div class="col-sm-8">
  <form class="form-group "action="../view/tela_resultado_pesquisa_filiado_nome.php" method="get">
  <input name="nome" id="txt_consulta" placeholder="Digite Nome do Filiado" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
  </div>
      


</div><!-- fim do Conteiner_principal -->

<?php require'footer.php';?>

 