<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit(); // Adiciona um exit após o redirecionamento para garantir que o script não continue
}
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADTC System | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Congregações</a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../index.php" class="brand-link">
      <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADTC System</span>
    </a>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../sair.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sair</p>
              </a>
            </li>                   
          </ul>
        </li>         
      </ul>
    </nav>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">
              <i class="fas fa-chart-line"></i> Relatórios
         </h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="processamento.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-4"> 
              <label for="congregacao" id="label_cor">Congregação</label>      
              <select class="form-control" id="congregacao" name="congregacao" required>                   
                <option value="">Selecione</option>
                <option value="SEDE">SEDE</option>
                <option value="ALEGRIA">ALEGRIA</option>
                <option value="JUBAIA">JUBAIA</option>
                <option value="LAGES">LAGES</option>
                <option value="NOVO MARANGUAPE 1">NOVO MARANGUAPE 1</option>
                <option value="NOVO MARANGUAPE 2">NOVO MARANGUAPE 2</option>
                <option value="NOVO MARANGUAPE 3">NOVO MARANGUAPE 3</option>
                <option value="NOVO MARANGUAPE 4">NOVO MARANGUAPE 4</option>                     
                <option value="OUTRA BANDA">OUTRA BANDA</option>
                <option value="PARQUE SÃO JOÃO">PARQUE SÃO JOÃO</option>
                <option value="NOVO PARQUE IRACEMA">NOVO PARQUE IRACEMA</option>
                <option value="SITIO SÃO LUIZ">SITIO SÃO LUIZ</option>
                <option value="TABATINGA">TABATINGA</option>
                <option value="UMARIZEIRAS">UMARIZEIRAS</option>
                <option value="VITÓRIA">VITÓRIA</option>
                <option value="VIÇOSA">VIÇOSA</option>
                <option value="PAPARA">PAPARA</option>
                <option value="PLANALTO">PLANALTO</option>
                <option value="SERRA JUBAIA">SERRA JUBAIA</option>
                <option value="IRACEMA">IRACEMA</option>
                <option value="PARAISO">PARAISO</option>
                <option value="CASTELO">CASTELO</option>
                <option value="LAMEIRÃO">LAMEIRÃO</option>                      
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
          <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <strong>&copy; 2021-2025 <a href="#">ADTC II - Maranguape</a>.</strong>
    Todos os direitos reservados
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.2.0
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
