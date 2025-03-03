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
require_once "../../db/config.php";
$total = 0;
$sql = "SELECT COUNT(*) as c FROM filiado";
$sql = $pdo->query($sql);
$sql = $sql->fetch();
$total = $sql['c'];     
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        .main-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa; /* altere a cor de fundo conforme necessário */
            padding: 10px 20px; /* ajuste o preenchimento conforme necessário */
            text-align: center;
            z-index: 1000; /* garante que o footer fique acima de outros elementos, se houver */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
        <li class="nav-item">
            <a href="../index_tesoureiro.php" class="nav-link">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="nav-item">
        <a href="../index_tesoureiro.php" class="nav-link">
            <i class="fas fa-user"></i> <?php echo $_SESSION['nome']?>
        </a>
        </li>
        <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        Congregação: <?php echo $_SESSION['congregacao']; ?>
                    </a>
                </li>
    </ul>    
  </nav>
  <!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../index_tesoureiro.php" class="brand-link">
    <img src="../../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">ADTC System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../index_tesoureiro.php" class="nav-link active">
            <i class="fas fa-home"></i>
            <p>Home</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../dizimo/lancamentos.php" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
            <p>Dízimos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="lancamentos.php" class="nav-link">
            <i class="nav-icon fas fa-hand-holding-usd"></i>
            <p>Ofertas</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="../dizimo/tela_relatorio_dizimo.php" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Consulta | Total</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="../../sair.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Sair</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ofertas</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <main class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-eye"></i> Visualizar</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Visualizar ofertas que foram lançadas.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="../oferta/tela_pesquisar_ofertas.php" class="btn btn-primary">Entrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-coins"> </i>Lançamentos</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Realizar lançamentos de ofertas do dia.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="tela_cadastro.php" class="btn btn-primary">Entrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </main>
    <!-- /.content -->

    <!-- Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        <b>Version</b> 1.2.0
      </div>
      <strong>Copyright &copy; 2021-2025 <a href="#">ADTC II - Maranguape</a>.</strong>
      Todos os direitos reservados.
    </footer>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
