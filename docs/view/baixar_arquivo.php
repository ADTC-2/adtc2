<?php
session_start();
if (!isset($_SESSION['email']) and !isset($_SESSION['email']) )
 {  
  //Limpa
  unset ($_SESSION['email']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:login.php'); 
  }
?>
<?php   
require_once "../db/config.php";
      $total =0;
          $sql ="SELECT COUNT(*) as c FROM filiado";
          $sql = $pdo->query($sql);
          $sql = $sql->fetch();
          $total = $sql['c'];     
?>
<!Doctype html>
<html lang='pt-br'>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADTC System | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Congregações</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Secretarios</a>
      </li>
    </ul>

   
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../imagens/img_carteira/logo sem fundo.png" alt="ADTC II" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">ADTC System</span>
    </a>



      <!-- Sidebar Menu -->
  <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
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
                <a href="../view/tela_cad_filiado.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Secretaria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view/lancamentos.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Financeiro</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="../view/gestao_documentos.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Documentos</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="../view/carta.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Emitir Carta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view/tela_carteira_filiado.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cartão de Membro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sair.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sair</p>
                </a>
              </li>                   
            </ul>
          </li>         
      </nav>      
    </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard - Report Congregações</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>SEDE</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_sede.php" class="small-box-footer">Baixar arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>NM I<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_nm1.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>NM II</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="tot_filiados_nm2.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>NM III</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="tot_filiados_nm3.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
  </div>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Sub Congr.NM IV</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_nm4.php" class="small-box-footer">Baixar arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Planalto<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_planalto.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Outra banda</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="tot_filiados_ouutrabanda.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Alegria</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="tot_filiados_alegria.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Pq S. João</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_parquesaojoao.php" class="small-box-footer">Baixar arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Novo Pq Iracema<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_parqueiracema.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Viçosa</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="tot_filiados_visoca.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Tabatinga</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="tot_filiados_tabatinga.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
  </div>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Vitória</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_vitoria.php" class="small-box-footer">Baixar arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Sitio S. Luiz<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_sitiosaoluiz.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Umarizeiras</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="tot_filiados_Umarizeiras.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Lajes</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="tot_filiados_lages.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
  </div>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Papara</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_papara.php" class="small-box-footer">Baixar arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Jubaia<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_jubaia.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Pé de Serra</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="tot_filiados_pedeserra.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Iracema</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="tot_filiados_iracema.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
  </div>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Castelo</h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_castelo.php" class="small-box-footer">Baixar arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Paraiso<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_paraiso.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Pato Selvagem<sup style="font-size: 20px"></sup></h3>

                <p>Total de Membros</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="tot_filiados_patoselvagem.php" class="small-box-footer">Baixar Arquivo <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
         
        </div>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
  </div>
  </div>






  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2025 <a href="#">ADTC II - Maranguape</a>.</strong>
    Todos os direitos reservados
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
