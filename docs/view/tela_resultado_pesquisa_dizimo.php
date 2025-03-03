<?php   
      require_once "../db/config.php";
       $consulta = $_GET['consulta'];
       $sql    = "SELECT * FROM filiado WHERE nome LIKE '$consulta%'";
       $sql    = $pdo->query($sql);
?>
<?php require_once'header.php';?>

<div class="container">	
<h1>Controle de  Dizímos & Ofertas</h1>
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
 <form class="form-group "action="../view/tela_resultado_pesquisa_filiado.php" method="POST">
  <a href="../view/tela_pesquisa_dizimista.php">Voltar</a>
  </form>
  </div>
      
	


<div class="row">
<div class="col-md-12">
	<div class="table-responsive" style="overflow: auto;border:solid 1px #FF4500;margin-top:10px;">
       <table class="table table-hover">
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
</div>

</div><!-- Linha 1 -->	
<br><br>

</div><!-- fim do Conteiner_principal -->

<?php require'footer.php';?>

 