<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
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
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .download-icon,
    .delete-icon {
        width: 25px;
        height: 25px;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>
            <div class="sidebar">
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
        </aside>
        <div class="content-wrapper">
            <main class="content">
                <h3>Lista de Cartas Solicitadas</h3>
                <table id="emitirTable" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Estado Civil</th>
                            <th>Cidade</th>
                            <th>Função</th>
                            <th>Status</th>
                            <th>Data Emissão</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                </table>
            </main>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        var table = $('#emitirTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "../emissao_carta/processamento_listar.php",
                "type": "POST",
                "dataType": "json",
                "error": function(xhr, error, code) {
                    console.log(xhr.responseText);
                }
            },
            "columns": [
                { "data": "id_emissao", "title": "ID" },
                { "data": "nome", "title": "Nome" },
                { "data": "estadocivil", "title": "Estado Civil" },
                { "data": "cidade", "title": "Cidade" },
                { "data": "funcao", "title": "Função" },
                { "data": "status", "title": "Status" },
                {
                    "data": "dataCaptura",
                    "title": "Data de Emissão",
                    "render": function(data) {
                        if (typeof data === 'string' && /^\d{4}-\d{2}-\d{2}$/.test(data)) {
                            const dateObj = new Date(data);
                            const formattedDate =
                                `${dateObj.getDate().toString().padStart(2, '0')}/${(dateObj.getMonth() + 1).toString().padStart(2, '0')}/${dateObj.getFullYear()}`;
                            return formattedDate;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    "data": null,
                    "title": "Editar",
                    "render": function(data, type, row) {
                        return '<button class="btn btn-warning btn-editar" data-id="' + data.id_emissao + '" data-nome="' + data.nome + '" data-estadocivil="' + data.estadocivil + '" data-cidade="' + data.cidade + '" data-funcao="' + data.funcao + '" data-status="' + data.status + '">Editar</button>';
                    }
                },
                {
                    "data": null,
                    "title": "Excluir",
                    "render": function(data, type, row) {
                        return '<button class="btn btn-danger btn-excluir" data-id="' + data.id_emissao + '"><i class="fas fa-trash-alt"></i></button>';
                    }
                }
            ],
            "responsive": true
        });

        $('#emitirTable').on('click', '.btn-editar', function() {
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var estadocivil = $(this).data('estadocivil');
            var cidade = $(this).data('cidade');
            var funcao = $(this).data('funcao');
            var status = $(this).data('status');

            window.location.href = 'display_carta.php?id=' + id + '&nome=' + nome + '&estadocivil=' + estadocivil + '&cidade=' + cidade + '&funcao=' + funcao + '&status=' + status;
        });

        $('#emitirTable').on('click', '.btn-excluir', function() {
            var id = $(this).data('id');
            excluirDocumento(id);
        });

        function excluirDocumento(id) {
            if (confirm('Tem certeza de que deseja excluir este registro?')) {
                $.ajax({
                    url: '../emissao_carta/processamento_excluir.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert('Registro excluído com sucesso.');
                            $('#emitirTable').DataTable().ajax.reload();
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
