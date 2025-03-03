<?php
session_start();

// Verifica se as variáveis de sessão 'nome' e 'senha' estão definidas
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Se não estiverem definidas, limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('Location: ../login.php');
    exit(); // Certifique-se de sair após redirecionar
}

// Inclui o arquivo de configuração do banco de dados
require '../db/config.php';

try {
    // Query SQL para selecionar todos os registros da tabela cartas
    $sql = "SELECT * FROM cartas";

    // Preparar a consulta
    $stmt = $pdo->prepare($sql);

    // Executar a consulta
    $stmt->execute();

    // Armazenar os resultados da consulta em um array associativo
    $cartas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Se houver um erro ao executar a consulta SQL, capture e exiba o erro
    echo "Erro ao recuperar dados: " . $e->getMessage();
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
        background-color: #f8f9fa;
        /* altere a cor de fundo conforme necessário */
        padding: 10px 20px;
        /* ajuste o preenchimento conforme necessário */
        text-align: center;
        z-index: 1000;
        /* garante que o footer fique acima de outros elementos, se houver */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
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
            <h3>Lista de Cartas Recebidas</h3>
            <main class="content">
                <table id="emitirTable" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data Emissão</th>
                            <th>Baixar</th>
                            <th>Excluir</th> <!-- Nova coluna para ações -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartas as $carta): ?>
                        <tr>
                            <td><?php echo $carta['id']; ?></td>
                            <td><?php echo $carta['nome']; ?></td>
                            <td>
                                <?php
                                // Formata a data apenas se $carta['dataEmissao'] não estiver vazio
                                if (!empty($carta['dataEmissao'])) {
                                    // Cria um objeto DateTime a partir da string de data do banco de dados
                                    $dataEmissao = new DateTime($carta['dataEmissao']);
                                    // Formata a data para o formato brasileiro (DD/MM/YYYY)
                                    echo $dataEmissao->format('d/m/Y');
                                } else {
                                    echo "Data não disponível";
                                }
                                ?>
                            </td>
                            <td>
                                <!-- Botão de Download -->
                                <a href="../emissao_carta/uploads/<?php echo $carta['nome_arquivo']; ?>" download>
                                    <i class="fas fa-download"></i> Baixar
                                </a>
                            </td> 
                            <td>    
                                <!-- Botão de Exclusão -->                               
                                <a href="processamento_excluir_upload.php?id=<?php echo $carta['id']; ?>">
                                    <i class="fas fa-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </main>
            <!-- /.content -->

            <!-- Footer -->
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
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        var table = $('#emitirTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "../emissao_carta/processamento_listar_cartasEnviadas.php",
                "type": "POST",
                "dataType": "json"
            },
            "columns": [{
                    "data": "id",
                    "title": "ID"
                },
                {
                    "data": "nome",
                    "title": "Nome"
                },
                {
                    "data": "dataEmissao",
                    "title": "Data Emissão",
                    "render": function(data) {
                        // Converte a data para o formato brasileiro (DD/MM/YYYY)
                        if (data) {
                            var dateObj = new Date(data);
                            var day = dateObj.getDate().toString().padStart(2, '0');
                            var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                            var year = dateObj.getFullYear();
                            return day + '/' + month + '/' + year;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    "data": null,
                    "title": "Baixar",
                    "render": function(data, type, row) {
                        return '<a href="../emissao_carta/uploads/' + row.nome_arquivo + '" download><i class="fas fa-download"></i> Baixar</a>';
                    }
                },
                {
                    "data": null,
                    "title": "Excluir",
                    "render": function(data, type, row) {
                        return '<a href="processamento_excluir_upload.php?id=' + row.id + '"><i class="fas fa-trash"></i> Excluir</a>';
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "responsive": true
        });
    });
    </script>
</body>

</html>
