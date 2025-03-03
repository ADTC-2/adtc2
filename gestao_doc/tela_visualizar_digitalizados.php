<?php
session_start();
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    //Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    //Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Saída após o redirecionamento para garantir que o script pare de ser executado
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
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    /* Estilos personalizados */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    table {
        margin: 0 auto;
        width: 80%;
        /* Ajuste conforme necessário */
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 10px;
        /* Aumentei o padding para melhorar o espaçamento */
        text-align: center;
        /* Centralizei o texto em todas as células */
    }

    th {
        background-color: #ddd;
        /* Mudei a cor de fundo do cabeçalho */
    }

    td:last-child {
        text-align: center;
    }

    .download-icon,
    .delete-icon {
        width: 25px;
        /* Aumentei o tamanho dos ícones */
        height: 25px;
        /* Aumentei o tamanho dos ícones */
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
                        <i class="fas fa-user">&nbsp;</i><strong><?php echo $_SESSION['nome']?></strong>
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
            <a href="#" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> ADTC2</span>
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
                            <a href="upload.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="view_doc.php" class="nav-link">
                                <i class="nav-icon fas fa-eye"></i>
                                <p>Visualizar</p>
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
                            <h3 class="m-0 text-dark">Gestão de Documentos | Upload | Digitalizados</h3>
                        </div>
                    </div>
                </div>
            </div>
            <main class="content">
                <table id="documentosTable1" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Tipo</th>
                            <th>Responsável</th>
                            <th>Data de Cadastro</th>
                            <th>Arquivo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
            </main>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
            <script>
            $(document).ready(function() {
                // Função para renderizar o link de download
                function renderDownloadLink(data, type, row) {
                    if (type === 'display') {
                        return '<a href="documentos/Digitalizados/' + row.arquivo +
                            '" title="Baixe arquivo" download><i class="fas fa-download"></i></a>';
                    }
                    return data;
                }

                $('#documentosTable1').DataTable({
                    "processing": false,
                    "serverSide": true,
                    "searching": true, // Habilitar a funcionalidade de busca
                    "ajax": {
                        "url": "listar_documentos_digitalizados.php", // Script PHP para buscar os dados
                        "type": "POST"
                    },
                    "columns": [{
                            "data": "id_digitalizados"
                        },
                        {
                            "data": "descricao"
                        },
                        {
                            "data": "tipo"
                        },
                        {
                            "data": "responsavel"
                        },
                        {
                            "data": "dataCadastro"
                        },
                        {
                            "data": null,
                            "render": renderDownloadLink // Usando a função para renderizar o link de download
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return '<a href="#" onclick="excluirDocumento(' + row.id +
                                    ')"><i class="fas fa-trash-alt"></i></a>';
                            }
                        }
                    ]
                });
            });

            // Função para excluir documento
            function excluirDocumento(id) {
                if (confirm('Tem certeza que deseja excluir este documento?')) {
                    // Chame o script PHP para excluir o documento
                    $.ajax({
                        url: 'excluir_documento_digitalizados.php',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            // Atualize a tabela após a exclusão
                            $('#documentosTable1').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Ocorreu um erro ao tentar excluir o documento.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            }
            </script>


</body>

</html>