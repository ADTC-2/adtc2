<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}
  require '../../db/config.php';

 $sql="SELECT * FROM ofertas";
 $sql=$pdo->query($sql);

  $id_ofertas= $_GET['id_ofertas'];

  $sql = "SELECT * FROM ofertas WHERE id_ofertas ='$id_ofertas' LIMIT 1";
  $sql=$pdo->query($sql);
  if ($sql->rowCount() > 0) {
    # code...
   foreach ($sql->fetchAll() as $linhas) {
     # code...
   }

  }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="css/agendamento.css">
  <title>Comprovante</title>  
</head>
<body>
<style>
        @media print {
            nav {
                display: none;
            }
        }
</style>
  <nav style="margin-left:50px;">
    <a href="#" onclick="window.print();" style="text-decoration:none;">
        <p id="texto_imprimir" ><?php echo rand(1,10)."   |  "."Imprimir";?></p>
    </a><a href="../oferta/lancamentos.php" class="navbar-brand"><i class="fas fa-arrow-left text-white"></i></a>
  </nav>
  <div class="conteiner">
  <div class="texto2">
      <img id="checkIn1" src="../../imagens/diversas_imagens/logAdtcII.png" alt="">
    </div>
  <hr>
  <h4><p style="text-align: left;margin-left: 80px;color:brown">Comprovante</p></h4> 

  <div class="texto4">
  <p id="dt_evento"><strong>Lançado em</strong> : <?php echo date("d/m/Y",strtotime($linhas['dataOferta']));?></p><br>  
  <p id="tipo_evento"><strong>Valor</strong> : R$ <?php echo number_format($linhas['valor'], 2, ',', '.'); ?></p><br>
  <p id="horario"><strong>Responsável</strong> : <?php echo $linhas['responsavel']; ?></p><br>
  <p id="telefone"><strong>Congregação</strong> : <?php echo $linhas['congregacao']; ?></p><br>
    
    </div>  
    <div class="texto3">
      <p id="declaracao"><strong></strong> <br>
         
       Campo para informações uteis</p>
    </div>

  </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
 