<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome'], $_SESSION['senha']);
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Verifica se o nível de acesso é "apoio" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] !== 'apoio' && $_SESSION['nivel'] !== 'admin')) {
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../css/lista.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../filiados/index.php">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['nome']); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-warehouse"></i> Congregação:
                        <?php echo htmlspecialchars($_SESSION['congregacao']); ?>
                    </a>
                </li>
                <li class="nav-item">
                            <a href="../filiados/views/tela_cad_filiado.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                Cadastro
                            </a>
                        </li>
                <li class="nav-item">
                    <a href="../sair.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Sair
                    </a>
                </li>
            </ul>
        </nav>

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
                            <a href="../filiados/index.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../filiados/views/tela_cad_filiado.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../sair.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="container">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">
                                    <i class="nav-icon fas fa-user"></i> Cadastro Filiado
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="content">
                    <!-- Tabela para desktop e dispositivos móveis -->
                    <div class="table-responsive">

                        <table id="emitirTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Matrícula</th>
                                    <th>Nome</th>
                                    <th>Arquivo</th>
                                    <th>Função</th>
                                    <th>Congregação</th> <!-- Nova coluna -->
                                    <th>Visualizar</th>
                                    <th>Imprimir</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#emitirTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true, // Habilita a responsividade
            "autoWidth": false,
            "ajax": {
                "url": "./processamento/lista_obreiro.php",
                "type": "POST",
                "data": function(d) {
                    d.nome = $('#nome').val();
                    d.matricula = $('#matricula').val();
                },
                "dataType": "json",
                "error": function(xhr, error, code) {
                    console.log(xhr.responseText);
                }
            },
            "columns": [{
                    "data": null,
                    "title": "<input type='checkbox' id='selectAll'>",
                    "render": function(data, type, row) {
                        return '<input type="checkbox" class="row-select" value="' + row
                            .matricula + '">';
                    },
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "matricula",
                    "title": "Matrícula",
                    "className": "text-center"
                },
                {
                    "data": "nome",
                    "title": "Nome",
                    "className": "text-center"
                },
                {
                    "data": "arquivo",
                    "title": "Arquivo",
                    "render": function(data, type, row) {
                        return '<img src="../imagens/' + data +
                            '" class="img-thumbnail img-fluid" style="width: 100px; height: 100px;">';
                    },
                    "className": "text-center"
                },
                {
                    "data": "funcao",
                    "title": "Função",
                    "className": "text-center"
                },
                {
                    "data": "congregacao", // Adiciona o campo de congregação
                    "title": "Congregação",
                    "className": "text-center"
                },
                {
                    "data": null,
                    "title": "Novo",
                    "render": function(data, type, row) {
                        return '<a href="../filiados/views/tela_cad_filiado.php' +
                            '" class="btn btn-info btn-sm"><i class="nav-icon fas fa-user"></i></a>';
                    },
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": null,
                    "title": "Alterar",
                    "render": function(data, type, row) {
                        return '<a href="../filiados/views/tela_alterar_filiado.php?matricula=' +
                            row.matricula +
                            '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    },
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            "order": [
                [1, 'asc']
            ],
            "paging": true,
            "searching": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "emptyTable": "Nenhum dado disponível",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(filtrado de _MAX_ entradas no total)",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "search": "Pesquisar:",
                "zeroRecords": "Nenhum registro encontrado",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            }
        });

        // Função personalizada de filtro
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var nomeSearch = $('#nomeSearch').val().toLowerCase();
                var congregacaoSearch = $('#congregacaoSearch').val().toLowerCase();
                var nome = data[2].toLowerCase(); // Índice da coluna "Nome"
                var congregacao = data[5].toLowerCase(); // Índice da coluna "Congregação"

                if (nome.includes(nomeSearch) && congregacao.includes(congregacaoSearch)) {
                    return true;
                }
                return false;
            }
        );

        // Atualiza a tabela quando o filtro é alterado
        $('#nomeSearch').on('keyup change', function() {
            table.draw();
        });

        $('#congregacaoSearch').on('keyup change', function() {
            table.draw();
        });

        // Seleção de todos os itens
        $('#selectAll').on('click', function() {
            var isChecked = $(this).prop('checked');
            $('.row-select').prop('checked', isChecked);
        });
    });
    </script>
</body>

</html>