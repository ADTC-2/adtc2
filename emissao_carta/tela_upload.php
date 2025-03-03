<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user nav-icon"></i> Usuario: <?php echo $_SESSION['nome']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        Congregação: <?php echo $_SESSION['congregacao']; ?>
                    </a>
                </li>
                </li>
            </ul>
      </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADTC System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link active">
              <i class="fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tela_emissao.php" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>Emissão</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tela_upload.php" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>Upload</p>
            </a>
          </li>
                    <li class="nav-item">
                        <a href="tela_lista.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Carta Emitidas</p>
                        </a>
                    </li>
          <li class="nav-item">
            <a href="../sair.php" class="nav-link">
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

    <!-- Main content -->
    <main class="content">
      <h3>Recebimento de Cartas de Mudança</h3>
      <form id="uploadForm" enctype="multipart/form-data">
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome">
          </div>
          <div class="col-md-5">
            <label for="arquivo" class="form-label">Arquivo</label>
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="arquivo" name="arquivo">
              <label class="input-group-text" for="arquivo">Upload</label>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-file-alt"></i> Enviar</button>
      </form>
    </main>
    
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
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
  $('#uploadForm').on('submit', function(e) {
    e.preventDefault(); // Previne o envio padrão do formulário

    var formData = new FormData(this); // Cria um objeto FormData

    $.ajax({
      url: 'processamento_upload.php', // O script para processar o formulário
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        alert('Formulário enviado com sucesso!');
        console.log(response);
      },
      error: function(xhr, status, error) {
        alert('Ocorreu um erro ao enviar o formulário.');
        console.log(xhr.responseText);
      }
    });
  });
});
</script>

</body>
</html>
