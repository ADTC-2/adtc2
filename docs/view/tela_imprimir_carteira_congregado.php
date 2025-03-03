<?php
  require_once "../db/config.php";
  
      $sql="SELECT * FROM filiado ";
      $sql=$pdo->query($sql);

    	 	   $matricula = $_GET['matricula'];
     
      $sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
      $sql = $pdo->query($sql);	 
    
     

  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>


<!Doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel='stylesheet' href='../css/style_tela_carteira_obreiro.css'>

  <title>Carteira Congregado</title>
  </head>
  <body>
  <div class="container">

 <!--Componentes das imagens da carteira -->

  <img id="modelo_cart_obreiro" src="../imagens/img_carteira/Carteira_Congregado.png" alt="">
  <img id="foto_carteira_obreiro"src="../imagens/<?php echo $linhas['arquivo'];?>" width="120" height="150" style="border-radius:10px;">

  <!--Componentes da frete carteira -->
  <p id="matricula_carteira"><strong>Matricula :</strong> <?php echo $linhas['matricula'];?></p>
  <p id="nome_carteira"><strong>Nome : </strong> <?php echo $linhas['nome'];?></p>  
  <p id="funcao_carteira"><strong>Cargo :</strong> <?php echo $linhas['funcao'];?></p>
  <p id="congregacao_carteira"><strong>Congregação : </strong> <?php echo $linhas['congregacao'];?></p>

   <!--Componentes da verso carteira -->

   <p id="documento_verso_carteira"><strong>Documento : </strong> <?php echo $linhas['documento'];?></p>
   <p id="dt_nasc_verso_carteira"><strong>Data Nascimento : </strong> <?php echo date("d/m/Y",strtotime($linhas['dataNascimento']));?></p>
   <p id="dt_batismo_verso_carteira"><strong>Data de Batismo : </strong><?php echo date("d/m/Y",strtotime($linhas['dataBatismo']));?></p>
   <p id="estadoCivil_verso_carteira"><strong>Estado Civil : </strong> <?php echo $linhas['estadoCivil'];?></p>
   <p id="mae_verso_carteira"><strong>Nome da Mãe : </strong> <?php echo $linhas['mae'];?></p>
   <p id="mae_verso_carteira"><strong>Nome do Pai : </strong><?php echo $linhas['pai'];?></p>

   <p id="central_verso_carteira"style="color:#000;">
          A Constituição Federal assegura a qualquer cidadão o direito a livre manifestação de pensamento,   
         á liberdade de crença ,ao livre exercicio de cultos religiosos,
         sendo o seu local e liturgia protegidos e a prestação assistência reliciosa nas instituições de internamento.CRRB/1988,art 5º,IV,VI,VII e VIII.Capitulo 1º,Art 5. CONSTITUIÇÃO FEDERAL
         <br>
         Esta credencial é nominal e intransferivel.O titular somente poderá porta-lá
         enquanto proceder conforme os principios da palavra de Deus.
        </p>
        <img  id="ass_responsavel_verso_carteira" src="../imagens/img_carteira/assinatura.png"style="color:#000;"/>  
             
                 
          <p id="linha_verso_carteira"style="color:#000;">------------------------------------------------------</strong></p> 
          <p id="nome_verso_responsavel"style="color:#000;">Pastor Presidente - <strong>Eribaldo Medeiros Coelho </strong></p>  
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

















<?php 
       }
      } 
    ?>



<?php require 'footer.php';?>