<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:login.php');
    exit();
}

require_once "../db/config.php";

$sql = "SELECT * FROM servico";
$query = $pdo->prepare($sql);
$query->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos ADTC2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Trabalhos ADTC2</a>
    </nav>
    <div class="container">
        <h2 class="mt-4">Lista de Serviços</h2>
        <div class="table-responsive">
            <table id="servicos" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Evento</th>
                        <th>Anotações</th>
                        <th>Congregação</th>
                        <th>Data Evento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($query->rowCount() > 0) {
                        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $linhas) {
                            echo "<tr>";
                            echo "<td>{$linhas['id']}</td>";
                            echo "<td>{$linhas['evento']}</td>";
                            echo "<td>{$linhas['anotacoes']}</td>";
                            echo "<td>{$linhas['congregacao']}</td>";
                            echo "<td>{$linhas['dt_evento']}</td>";                           
                            echo "<td>
                                    <a href='tela_alterar_servico.php?id={$linhas['id']}' class='btn btn-sm btn-warning'>Editar</a>
                                  </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#servicos').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
</body>
</html>













