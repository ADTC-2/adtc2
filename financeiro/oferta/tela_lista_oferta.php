<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

require '../../db/config.php'; // Certifique-se de que este arquivo está incluído e define $pdo

// Parâmetros da paginação
$porPagina = 10; // Quantidade de resultados por página
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual, padrão é 1
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';
$dataOferta = isset($_GET['data_oferta']) ? $_GET['data_oferta'] : '';

// Consulta total de registros e valor total
$totalRegistros = 0;
$totalValor = 0;

if ($congregacao === "Alves" || $congregacao === "Marcos" || $congregacao === '') {
    if ($dataOferta) {
        $query = $pdo->prepare("SELECT COUNT(*) FROM ofertas WHERE DATE(dataOferta) = :dataOferta");
        $query->bindParam(':dataOferta', $dataOferta);
        $query->execute();
        $totalRegistros = $query->fetchColumn();

        $query = $pdo->prepare("SELECT SUM(valor) FROM ofertas WHERE DATE(dataOferta) = :dataOferta");
        $query->bindParam(':dataOferta', $dataOferta);
        $query->execute();
        $totalValor = $query->fetchColumn();
    } else {
        $totalRegistros = $pdo->query("SELECT COUNT(*) FROM ofertas")->fetchColumn();
        $totalValor = $pdo->query("SELECT SUM(valor) FROM ofertas")->fetchColumn();
    }
} else {
    if ($dataOferta) {
        $query = $pdo->prepare("SELECT COUNT(*) FROM ofertas WHERE congregacao = :congregacao AND DATE(dataOferta) = :dataOferta");
        $query->bindParam(':congregacao', $congregacao);
        $query->bindParam(':dataOferta', $dataOferta);
        $query->execute();
        $totalRegistros = $query->fetchColumn();

        $query = $pdo->prepare("SELECT SUM(valor) FROM ofertas WHERE congregacao = :congregacao AND DATE(dataOferta) = :dataOferta");
        $query->bindParam(':congregacao', $congregacao);
        $query->bindParam(':dataOferta', $dataOferta);
        $query->execute();
        $totalValor = $query->fetchColumn();
    } else {
        $query = $pdo->prepare("SELECT COUNT(*) FROM ofertas WHERE congregacao = :congregacao");
        $query->bindParam(':congregacao', $congregacao);
        $query->execute();
        $totalRegistros = $query->fetchColumn();

        $query = $pdo->prepare("SELECT SUM(valor) FROM ofertas WHERE congregacao = :congregacao");
        $query->bindParam(':congregacao', $congregacao);
        $query->execute();
        $totalValor = $query->fetchColumn();
    }
}

// Cálculo para determinar o número total de páginas
$totalPaginas = ceil($totalRegistros / $porPagina);

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta com LIMIT para a paginação
if ($congregacao === "Alves" || $congregacao === "Marcos" || $congregacao === '') {
    if ($dataOferta) {
        $sql = "SELECT * FROM ofertas WHERE DATE(dataOferta) = :dataOferta LIMIT $indiceInicio, $porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':dataOferta', $dataOferta);
    } else {
        $sql = "SELECT * FROM ofertas LIMIT $indiceInicio, $porPagina";
        $query = $pdo->query($sql);
    }
} else {
    if ($dataOferta) {
        $sql = "SELECT * FROM ofertas WHERE congregacao = :congregacao AND DATE(dataOferta) = :dataOferta LIMIT $indiceInicio, $porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':congregacao', $congregacao);
        $query->bindParam(':dataOferta', $dataOferta);
    } else {
        $sql = "SELECT * FROM ofertas WHERE congregacao = :congregacao LIMIT $indiceInicio, $porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':congregacao', $congregacao);
    }
}

// Execute a consulta
$query->execute();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ofertas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <style>
    body {
        padding-top: 20px;
    }

    .table th,
    .table td {
        padding: 10px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Back Button -->
        <div class="row">
            <div class="col">
                <a href="../oferta/lancamentos.php" class="navbar-brand">
                    <i class="fas fa-arrow-left text-black"></i>
                </a>
            </div>
        </div>

        <!-- Title -->
        <h4 class="text-center">Lista de Ofertas</h4>

        <!-- Offers Table -->
        <table id="ofertasTable" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Transação</th>
                    <th>Data Oferta</th>
                    <th>Valor</th>
                    <th>Congregação</th>
                    <th>Excluir</th>
                    <th>Alterar</th>
                    <th>Comprovante</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($query) && $query->rowCount() > 0): ?>
                <?php foreach ($query->fetchAll() as $linhas): ?>
                <tr>
                    <td><?php echo htmlspecialchars($linhas['id_ofertas']); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($linhas['dataOferta'])); ?></td>
                    <td><?php echo htmlspecialchars($linhas['valor']); ?></td>
                    <td><?php echo htmlspecialchars($linhas['congregacao']); ?></td>
                    <td>
                        <a href="procedimento_excluir_oferta.php?id_ofertas=<?php echo htmlspecialchars($linhas['id_ofertas']); ?>">
                            <img src="../../imagens/diversas_imagens/excluir.png" width="25" height="20">
                        </a>
                    </td>
                    <td>
                        <a href="tela_alterar_oferta.php?id_ofertas=<?php echo htmlspecialchars($linhas['id_ofertas']); ?>">
                            <img src="../../imagens/diversas_imagens/editar.png" width="25" height="20">
                        </a>
                    </td>
                    <td>
                        <a href="tela_comprovante_oferta.php?id_ofertas=<?php echo htmlspecialchars($linhas['id_ofertas']); ?>">
                            <img src="../../imagens/diversas_imagens/download.png" width="25" height="20">
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7">Nenhuma oferta encontrada.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Total Information -->
        <div class="row">
            <div class="col-md-6">
                <h5>Total de Ofertas: <?php echo number_format($totalRegistros, 0, ',', '.'); ?></h5>
            </div>
            <div class="col-md-6">
                <h5>Total em Valor: <?php echo number_format($totalValor, 2, ',', '.'); ?></h5>
            </div>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo ($paginaAtual == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>&congregacao=<?php echo htmlspecialchars($congregacao); ?>&data_oferta=<?php echo htmlspecialchars($dataOferta); ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ofertasTable').DataTable();
        });
    </script>
</body>

</html>
