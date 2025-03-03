<?php
session_start();
require '../db/config.php';

// Validação de sessão
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    header('location: ../login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    .main-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        padding: 10px 20px;
        text-align: center;
        z-index: 1000;
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
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-user"> Usuário</i> <?php echo $_SESSION['nome']?>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">
                    <i class="fas fa-warehouse nav-icon"></i>
                    Congregação <?php echo $_SESSION['congregacao']; ?>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Aniversariantes do Mês</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-md-8 offset-md-2">
                                <div class="container">
                                    <table id="aniversariantes" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Data de Nascimento</th>
                                                <th>Congregação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Os dados serão preenchidos dinamicamente pelo JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /.wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>

    <!-- Seu código JavaScript personalizado -->
    <script>
        $(document).ready(function() {
            // Obtém o mês atual
            var date = new Date();
            var mes = date.getMonth() + 1; // JavaScript usa índices de mês de 0 a 11

            // Chama o PHP para obter os dados dos aniversariantes do mês atual
            $.ajax({
                url: 'buscar.php',
                type: 'GET',
                data: { mes: mes }, // Envia o mês via parâmetro GET
                dataType: 'json',
                success: function(data) {
                    // Preenche a tabela com os dados retornados
                    var table = $('#aniversariantes').DataTable({
                        data: data,
                        columns: [
                            { data: 'nome' },
                            { 
                                data: 'dataNascimento',
                                render: function(data) {
                                    // Formata a data no formato brasileiro (dd/mm/yyyy)
                                    var dateParts = data.split('-');
                                    var formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];
                                    return formattedDate;
                                }
                            },
                            { data: 'congregacao' } // Adiciona a coluna de congregação
                        ]
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Erro ao obter os dados:', textStatus, errorThrown);
                }
            });
        });
    </script>
</body>

</html>
