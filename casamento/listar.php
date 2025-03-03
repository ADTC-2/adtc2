<?php
// Inicia a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conectar ao banco de dados
require '../db/config.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit();
}

// Verifica se o nível de acesso é "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    // Redireciona para uma página de acesso negado
    header('Location: acesso_negado.php');
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
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .print-icon {
        width: 25px;
        height: 25px;
    }

    .img-thumbnail {
        width: 100px;
        height: auto;
    }

    .filter-form {
        margin-bottom: 20px;
    }

    .table-responsive {
        margin: 20px;
    }

    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            white-space: nowrap;
            text-align: left;
            padding: 8px;
        }

        tbody td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        thead {
            display: none;
        }

        tr {
            display: block;
            margin-bottom: 1em;
        }

        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: .5em;
        }
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
            <!-- Navbar toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-warehouse"></i> Congregação:
                            <?php echo htmlspecialchars($_SESSION['congregacao'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../sair.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i></a>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="./../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="./index.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./form.php" class="nav-link">
                                 <i class="nav-icon fas fa-user-plus"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./form_alterar.php" class="nav-link">
                                 <i class="nav-icon fas fa-user-plus"></i>
                                <p>Alterar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./listar.php" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./../gestao_doc/cadastro_doc_digitalizados.php" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>Doc Assinados</p>
                            </a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="../sair.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-calendar"></i> Registro de Casamento</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <main class="content">
                <div class="container">
                    <table id="casamentos-table" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Noivo</th>
                                <th>Nome da Noiva</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- As linhas da tabela serão inseridas aqui pelo script AJAX -->
                        </tbody>
                    </table>
                </div>
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- Bootstrap Bundle com Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
 $(document).ready(function() {
            // Inicializa o DataTable
            var table = $('#casamentos-table').DataTable({
                responsive: true,
                ajax: {
                    url: 'buscar_registro.php',
                    dataSrc: 'data',
                    type: 'GET',
                    dataType: 'json',
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição AJAX:', error);
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'nome_noivo' },
                    { data: 'nome_noiva' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info btn-sm edit-btn" data-id="${row.id}">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button class="btn btn-primary btn-sm view-btn" data-id="${row.id}">
                                    <i class="fas fa-eye"></i> Visualizar
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id} disabled">
                                    <i class="fas fa-trash"></i> Excluir
                                </button>
                            `;
                        },
                        orderable: false
                    }
                ]
            });

            // Ação dos botões Editar
            $('#casamentos-table').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                window.location.href = 'form_alterar.php?id=' + id;
            });

            // Ação dos botões Visualizar
            $('#casamentos-table').on('click', '.view-btn', function() {
                var id = $(this).data('id');
                window.location.href = 'generate.php?id=' + id;
            });

            // Ação dos botões Excluir
                $('#casamentos-table').on('click', '.delete-btn', function() {
                    var id = $(this).data('id');
                    if (confirm('Tem certeza que deseja excluir este registro?')) {
                        $.ajax({
                            url: 'excluir.php',
                            type: 'POST',
                            data: { id: id },
                            success: function(response) {
                                var result = JSON.parse(response);
                                if (result.success) {
                                    // Remover a linha da tabela ou recarregar a tabela
                                    $('#casamento-row-' + id).remove(); // Supondo que cada linha tenha um ID único
                                   
                                    window.location.href = 'listar.php';
                                } else {
                                    alert('Falha ao excluir o registro: ' + result.error);
                                }
                            },
                            error: function() {
                                alert('Erro ao processar a solicitação.');
                            }
                        });
                    }
                });
        });
    </script>
</body>
</html>

