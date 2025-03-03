<?php
session_start();

if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {
  //Destrói
  session_destroy();

  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:../login.php');
}  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <!-- Font Awesome -->
 <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <title>Criar Envelope</title>
  <style>
    #imagem {
      width: 150px; /* Definindo a largura da imagem */
      height: auto; /* Mantendo a proporção da imagem */
    }
  </style>
</head>
<body>
  <div class="container">

  </div>	
  <div class="container"><!-- Inicio -->  
    <hr>
    <h3><i class="fas fa-envelope text-dark"></i> Emissão - Envelope de Dízimo</h3>


    <div><img id="imagem" src="../imagens/img_carteira/ADTC2 VERMELHO.png" alt="logotipo"></div>
    <form id="formulario" action="mostrar_envelope.php" method="GET">
      <hr>
      
      <div class="form-row">
        <div class="form-group col-md-8">
          <select type="text" class="form-control" placeholder="Congregação" name="congregacao">
            <option>QUAL A CONGREGAÇÃO ?</option>
            <option>SEDE</option>
            <option>PARQUE SÃO JOÃO</option>
            <option>UMARIZEIRAS</option>
            <option>OUTRA BANDA</option>
            <option>NOVO PARQUE IRACEMA</option>
            <option>NOVO PARQUE IRACEMA 2</option>
            <option>PAPARA</option>
            <option>JUBAIA</option>
            <option>LAGES</option>
            <option>PLANALTO</option>
            <option>ALEGRIA</option>
            <option>TABATINGA</option>
            <option>SERRA JUBAIA</option>
            <option>VITORIA</option>
            <option>VIÇOSA</option>
            <option>SITIO SÃO LUIZ</option>
            <option>NOVO MARANGUAPE 1</option>
            <option>NOVO MARANGUAPE 2</option>
            <option>NOVO MARANGUAPE 3</option>
            <option>NOVO MARANGUAPE 4</option>
            <option>CASTELO</option>
            <option>IRACEMA</option>
            <option>PARAISO</option>
            <option>LAMEIRÃO</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Criar Envelope</button>
      <a href="#" onclick="history.back();" class="btn btn-secondary">Voltar</a>
    </form>

  </div><!-- Fim conteiner -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>









