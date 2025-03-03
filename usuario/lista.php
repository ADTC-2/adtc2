<?php
session_start();
require_once "../db/config.php";
// Verificar se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header('Location: login.php');
    exit; // Encerrar o script para evitar que o restante da página seja carregado
}

// Verificar se o usuário possui o nível de permissão de administrador
if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}
      $total =0;
          $sql ="SELECT COUNT(*) as c FROM filiado";
          $sql = $pdo->query($sql);
          $sql = $sql->fetch();
          $total = $sql['c'];     
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="home.php" class="nav-link">
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
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="home.php" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cadastro.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lista.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Lista</p>
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
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Lista de Usuários</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid">
                    <!-- DataTables -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de Usuários</h3>
                                </div>
                                <div class="card-body">
                                    <table id="usuarioTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Nível</th>
                                                <th>Senha</th>
                                                <th>Congregação</th>
                                                <th>Matrícula</th>
                                                <th>Data de Cadastro</th>
                                                <th>Editar</th> <!-- Coluna de ações -->
                                                <th>Excluir</th> <!-- Coluna de ações -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Os dados serão preenchidos via AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
$(document).ready(function() {
    var table = $('#usuarioTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../usuario/processamento/get_users.php",
            "type": "POST",
            "dataType": "json",
            "error": function(xhr, error, code) {
                console.log(xhr.responseText);
            }
        },
        "columns": [
            { "data": "id", "title": "ID" },
            { "data": "matricula", "title": "Matrícula" }, // Adiciona a coluna de matrícula
            { "data": "nome", "title": "Nome" },
            { "data": "nivel", "title": "Nível" },
            { "data": "senha", "title": "Senha" },
            { "data": "congregacao", "title": "Congregação" },
            {
                "data": "dataCaptura",
                "title": "Data de Cadastro",
                "render": function(data) {
                    if (typeof data === 'string' && /^\d{4}-\d{2}-\d{2}$/.test(data)) {
                        const dateObj = new Date(data);
                        const formattedDate =
                            `${dateObj.getDate().toString().padStart(2, '0')}/${(dateObj.getMonth() + 1).toString().padStart(2, '0')}/${dateObj.getFullYear()}`;
                        return formattedDate;
                    }
                    return data;
                }
            },
            {
                "data": null,
                "title": "Editar",
                "render": function(data) {
                    return '<button class="btn btn-primary btn-editar" data-id="' + data.id + '" data-matricula="' + data.matricula + '" data-nome="' + data.nome + '" data-nivel="' + data.nivel + '" data-senha="' + data.senha + '" data-dataCaptura="' + data.dataCaptura + '" data-congregacao="' + data.congregacao + '"><i class="fas fa-edit"></i></button>';
                }
            },
            {
                "data": null,
                "title": "Excluir",
                "render": function(data) {
                    return '<button class="btn btn-danger btn-excluir" data-id="' + data.id + '"><i class="fas fa-trash-alt"></i></button>';
                }
            }
        ],
        "responsive": true
    });

    $('#usuarioTable').on('click', '.btn-editar', function() {
        var id = $(this).data('id');
        var matricula = $(this).data('matricula'); // Incluindo matrícula
        var nome = $(this).data('nome');
        var nivel = $(this).data('nivel');
        var senha = $(this).data('senha');
        var dataCaptura = $(this).data('dataCaptura');
        var congregacao = $(this).data('congregacao');

        window.location.href = 'editar.php?id=' + id + '&matricula=' + matricula + '&nome=' + nome + '&nivel=' + nivel + '&senha=' + senha + '&dataCaptura=' + dataCaptura + '&congregacao=' + congregacao;
    });

    $('#usuarioTable').on('click', '.btn-excluir', function() {
        var id = $(this).data('id');
        excluirDocumento(id);
    });

    function excluirDocumento(id) {
        if (confirm('Tem certeza de que deseja excluir este registro?')) {
            $.ajax({
                url: '../usuario/processamento/excluir.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Registro excluído com sucesso.');
                        $('#usuarioTable').DataTable().ajax.reload();
                    } else {
                        alert('Falha ao excluir o registro. Tente novamente.');
                    }
                },
                error: function() {
                    alert('Erro na solicitação. Verifique sua conexão e tente novamente.');
                }
            });
        }
    }
});

    </script>
</body>
</html>





