<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:login.php');
    exit();
}

// Verifica se o nível de acesso é "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'admin')) {
    header('location:acesso_negado.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .card {
        margin-bottom: 20px;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .card-header {
        background-color: #e9ecef;
        font-weight: bold;
        cursor: pointer;
    }

    .card-body {
        display: none;
        background-color: #fff;
    }

    .card-body.show {
        display: block;
    }

    .pagination {
        justify-content: center;
    }
    .btn-excluir {
        margin-right: 10px; /* Ajusta o espaço entre os botões */
    }

    .container-fluid {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .navbar-nav {
            text-align: center;
        }
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                            <a href="./cadastro.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./listar.php" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>Consultar</p>
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
                            <h3 class="m-0 text-dark">Ata Oficial de Reunião do Ministério </h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div id="reunioesTableContainer"></div>
                            <!-- Pagination controls -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination" id="paginationControls"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/pt-br.min.js"></script>
    <script>
$(document).ready(function() {
    var maxPagesToShow = 10; // Máximo de páginas a serem exibidas de cada vez

    function loadPage(page) {
        $.ajax({
            url: 'processa_reunioes.php',
            type: 'GET',
            dataType: 'json',
            data: {
                page: page
            },
            success: function(response) {
                var container = $('#reunioesTableContainer');
                var paginationControls = $('#paginationControls');
                container.empty(); // Limpa o container antes de adicionar novos dados
                paginationControls.empty(); // Limpa os controles de paginação

                if (response.error) {
                    container.append('<div class="alert alert-danger">' + response.error + '</div>');
                } else if (response.data && Array.isArray(response.data)) {
                    $.each(response.data, function(index, reuniao) {
                        var dataReuniao = moment(reuniao.data_reuniao).locale('pt-br').format('dddd, D [de] MMMM [de] YYYY');
                        container.append(
                            '<div class="card">' +
                            '<div class="card-header">' +
                            '<h5 class="card-title">ATA de Nº : ' + reuniao.id + ' - ' + dataReuniao + '</h5>' +
                            '</div>' +
                            '<div class="card-body">' +
                            '<p><strong>Local:</strong> ' + reuniao.local + '</p>' +
                            '<p><strong>Tipo:</strong> ' + reuniao.tipo + '</p>' +
                            '<p><strong>Conteúdo:</strong> ' + reuniao.conteudo + '</p>' +
                            '<button class="btn btn-danger btn-excluir mr-2" data-id="' + reuniao.id + '"><i class="fas fa-trash-alt"></i></button>' +
                            '<button class="btn btn-primary btn-imprimir" data-id="' + reuniao.id + '"><i class="fas fa-print"></i></button>' +
                            '</div>' +
                            '</div>'
                        );
                    });

                    // Adiciona controles de paginação
                    var startPage = Math.max(1, page - Math.floor(maxPagesToShow / 2));
                    var endPage = Math.min(response.total_pages, startPage + maxPagesToShow - 1);

                    if (startPage > 1) {
                        paginationControls.append('<li class="page-item"><a class="page-link" href="#" data-page="1">Primeira</a></li>');
                        paginationControls.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (startPage - 1) + '">Anterior</a></li>');
                    }

                    for (var i = startPage; i <= endPage; i++) {
                        var activeClass = (i === page) ? 'active' : '';
                        paginationControls.append(
                            '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>'
                        );
                    }

                    if (endPage < response.total_pages) {
                        paginationControls.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (endPage + 1) + '">Próxima</a></li>');
                        paginationControls.append('<li class="page-item"><a class="page-link" href="#" data-page="' + response.total_pages + '">Última</a></li>');
                    }
                } else {
                    container.append('<div class="alert alert-info">Nenhuma reunião encontrada.</div>');
                }
            },
            error: function() {
                $('#reunioesTableContainer').html('<div class="alert alert-danger">Erro ao carregar dados.</div>');
            }
        });
    }

    // Carrega a página inicial
    loadPage(1);

    // Evento de clique nos controles de paginação
    $(document).on('click', '#paginationControls .page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        if (page) {
            loadPage(page);
        }
    });

    // Alterna a visibilidade do corpo do cartão
    $(document).on('click', '.card-header', function() {
        $(this).next('.card-body').toggleClass('show');
    });

    // Botão de exclusão
    $(document).on('click', '.btn-excluir', function() {
        var id = $(this).data('id');
        if (confirm('Tem certeza de que deseja excluir esta reunião?')) {
            $.ajax({
                url: 'excluir_reuniao.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        alert('Reunião excluída com sucesso.');
                        loadPage(1); // Recarregar a primeira página após exclusão
                    } else {
                        alert('Erro ao excluir a reunião. Tente novamente.');
                    }
                },
                error: function() {
                    alert('Erro ao conectar ao servidor.');
                }
            });
        }
    });

    // Botão de impressão
    $(document).on('click', '.btn-imprimir', function() {
        var id = $(this).data('id');
        window.open('impressao_reuniao.php?id=' + id, '_blank');
    });
});
</script>




</body>

</html>