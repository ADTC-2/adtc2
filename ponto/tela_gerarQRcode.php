<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {  
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    
    // Redireciona para a página de autenticação
    header('location: login.php');   
    exit;
}

require_once "../db/config.php";

$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$sql = "SELECT * FROM filiado";
$sql .= " WHERE nome LIKE '$nome%'";
$sql .= " LIMIT 1";
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $resultado) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Gerar QRcode</title>
  <style>
    /* Estilos personalizados */
    body {
      padding-top: 20px;
    }
    .navbar {
      margin-bottom: 20px;
    }
    .container {
      max-width: 600px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .btn-block {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">Gerar QRCode</a>
  </nav>
  <div class="container">
   <form novalidate class="needs-validation" action="procedimento_gerarQRcode.php" method="POST" enctype="multipart/form-data">
   <div class="form-row">        
        <div class="col form-group">
           <label for="matricula">Matricula</label>
           <input type="text" name="matricula" class="form-control is-valid" id="matricula" value="<?php echo $resultado['matricula'];?>">
        </div>
    </div><!-- end div-form-row--> 
    <div class="form-row">        
        <div class="col form-group">
           <label for="nome">Nome</label>
           <input type="text" name="nome" class="form-control is-valid" id="nome" value="<?php echo $resultado['nome'];?>">
        </div>
    </div><!-- end div-form-row-->    
    <button type="submit" class="btn btn-primary btn-block">Gerar QRCode</button>
    <a href="tela_cadastro.php?nome=<?php echo $resultado['nome']; ?>" class="btn btn-info btn-block">Associar</a>    
    <a href="tela_lista_ponto.php" class="btn btn-info btn-block">Lista de QRCode </a>  
    <a href="tela_relatorio_ponto.php" class="btn btn-primary btn-block">Relatório Presenças</a>           
   </form><!-- end form-->
  </div><!-- end div-container-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
<script>
    window.addEventListener('load', e => {
        const form = document.querySelector('form');

        form.addEventListener('submit', es => {
            if (form.checkValidity() === false){
                es.preventDefault();
                es.stopImmediatePropagation();
            }
        });
        form.classList.add('was-validated')  
    });
</script>
<?php
        }
    } else {
       echo "Não encontrado!";
    }
?>
