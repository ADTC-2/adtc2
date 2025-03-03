<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha']) || !isset($_SESSION['nivel']) || !isset($_SESSION['congregacao'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    unset($_SESSION['nivel']);
    unset($_SESSION['congregacao']);
    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Armazena a congregação e o nível do usuário
$congregacaoUsuario = $_SESSION['congregacao'];
$nivelUsuario = $_SESSION['nivel'];

require '../../db/config.php';

$porPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$dataFiltro = isset($_GET['data']) ? $_GET['data'] : '';
$congregacaoFiltro = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';

// Consulta total de registros
if ($nivelUsuario == 'admin') {
    // Admin pode ver todas as congregações
    $totalRegistros = $pdo->prepare("SELECT COUNT(*) FROM dizimo WHERE (:congregacaoFiltro = '' OR congregacao = :congregacaoFiltro) AND (DATE(dataCaptura) = :dataFiltro OR :dataFiltro = '')");
    $totalRegistros->bindParam(':congregacaoFiltro', $congregacaoFiltro, PDO::PARAM_STR);
    $totalRegistros->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
    $totalRegistros->execute();
} else {
    // Usuário financeiro vê apenas sua congregação
    $totalRegistros = $pdo->prepare("SELECT COUNT(*) FROM dizimo WHERE congregacao = :congregacao AND (DATE(dataCaptura) = :dataFiltro OR :dataFiltro = '')");
    $totalRegistros->bindParam(':congregacao', $congregacaoUsuario, PDO::PARAM_STR);
    $totalRegistros->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
    $totalRegistros->execute();
}

$totalRegistros = $totalRegistros->fetchColumn();
$totalPaginas = ceil($totalRegistros / $porPagina);
$indiceInicio = ($paginaAtual - 1) * $porPagina;

function getDizimoQuery($pdo, $indiceInicio, $porPagina, $nivelUsuario, $congregacaoUsuario, $dataFiltro = '', $congregacaoFiltro = '') {
    $sql = "SELECT * FROM dizimo WHERE 1=1";
    
    if ($nivelUsuario != 'admin') {
        // Usuário financeiro vê apenas sua congregação
        $sql .= " AND congregacao = :congregacao";
    } else if ($congregacaoFiltro) {
        // Admin com filtro de congregação
        $sql .= " AND congregacao = :congregacaoFiltro";
    }
    
    if ($dataFiltro) {
        $sql .= " AND DATE(dataCaptura) = :dataFiltro";
    }
    
    $sql .= " LIMIT :indiceInicio, :porPagina";
    $query = $pdo->prepare($sql);
    
    if ($nivelUsuario != 'admin') {
        $query->bindParam(':congregacao', $congregacaoUsuario, PDO::PARAM_STR);
    } else if ($congregacaoFiltro) {
        $query->bindParam(':congregacaoFiltro', $congregacaoFiltro, PDO::PARAM_STR);
    }
    
    if ($dataFiltro) {
        $query->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
    }
    
    $query->bindParam(':indiceInicio', $indiceInicio, PDO::PARAM_INT);
    $query->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
    $query->execute();
    return $query;
}

$query = getDizimoQuery($pdo, $indiceInicio, $porPagina, $nivelUsuario, $congregacaoUsuario, $dataFiltro, $congregacaoFiltro);

// Consulta para a soma dos valores
function getTotalSum($pdo, $nivelUsuario, $congregacaoUsuario, $dataFiltro = '', $congregacaoFiltro = '') {
    $sql = "SELECT SUM(valor) as total FROM dizimo WHERE 1=1";
    
    if ($nivelUsuario != 'admin') {
        $sql .= " AND congregacao = :congregacao";
    } else if ($congregacaoFiltro) {
        $sql .= " AND congregacao = :congregacaoFiltro";
    }
    
    if ($dataFiltro) {
        $sql .= " AND DATE(dataCaptura) = :dataFiltro";
    }
    
    $query = $pdo->prepare($sql);
    
    if ($nivelUsuario != 'admin') {
        $query->bindParam(':congregacao', $congregacaoUsuario, PDO::PARAM_STR);
    } else if ($congregacaoFiltro) {
        $query->bindParam(':congregacaoFiltro', $congregacaoFiltro, PDO::PARAM_STR);
    }
    
    if ($dataFiltro) {
        $query->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
    }
    
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC)['total'];
}

$totalSum = getTotalSum($pdo, $nivelUsuario, $congregacaoUsuario, $dataFiltro, $congregacaoFiltro);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <style>
        /* Estilização da tabela */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            align-items: center;
        }
        /* ... (restante do CSS) ... */
    </style>
</head>

<body>
    <div class="container">
        <h1><a href="../dizimo/lancamentos.php" class="navbar-brand"><i class="fas fa-arrow-left"></i></a></h1>
        <a href="tela_cadastro.php">Cadastro</a>
        <hr style="border: 1px solid #008000;">

        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <label for="dataFiltro" class="mr-2">Filtrar por data:</label>
                <input type="date" id="dataFiltro" class="form-control">
                <button class="btn btn-primary ml-2" onclick="filtrarPorData()">Filtrar</button>
            </div>
            <?php if ($nivelUsuario === "admin") { ?>
            <div class="col-md-6 d-flex align-items-center">
                <label for="congregacao" class="mr-2">Filtrar por congregação:</label>
                <select id="congregacao" class="form-control">
                    <option value="">Todas as Congregações</option>
                    <option>SEDE</option>
                    <option>ALEGRIA</option>
                    <option>JUBAIA</option>
                    <option>LAGES</option>
                    <option>NOVO MARANGUAPE 1</option>
                    <option>NOVO MARANGUAPE 2</option>
                    <option>NOVO MARANGUAPE 3</option>
                    <option>NOVO MARANGUAPE 4</option>
                    <option>OUTRA BANDA</option>
                    <option>PARQUE SÃO JOÃO</option>
                    <option>NOVO PARQUE IRACEMA</option>
                    <option>SITIO SÃO LUIZ</option>
                    <option>TABATINGA</option>
                    <option>UMARIZEIRAS</option>
                    <option>VITÓRIA</option>
                    <option>VIÇOSA</option>
                    <option>PAPARA</option>
                    <option>PLANALTO</option>
                    <option>SERRA JUBAIA</option>
                    <option>IRACEMA</option>
                    <option>PARAISO</option>
                    <option>CASTELO</option>
                    <option>LAMEIRÃO</option>
                    <!-- Adicione outras opções conforme necessário -->
                </select>
                <button class="btn btn-primary ml-2" onclick="filtrarPorDataECongregacao()">Filtrar</button>
            </div>
            <?php } ?>
        </div>

        <!-- Tabela de registros -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <!-- Cabeçalho da tabela -->
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Nome</th>
                                <th>Congregação</th>
                                <th>Valor</th>
                                <th>Data Lançamento</th>
                                <th>Comprovante</th>
                                <th>Alterar</th>

                            </tr>
                        </thead>
                        <!-- Corpo da tabela -->
                        <tbody>
                            <?php while ($dizimo = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?= htmlspecialchars($dizimo['id_dizimo']) ?></td>
                                <td><?= htmlspecialchars($dizimo['nome']) ?></td>
                                <td><?= htmlspecialchars($dizimo['congregacao']) ?></td>
                                <td>R$ <?= number_format($dizimo['valor'], 2, ',', '.') ?></td>
                                <td><?= date('d/m/Y', strtotime($dizimo['dataCaptura'])) ?></td>
                                <td>
                                    <a href="tela_comprovante_dizimo.php?id_dizimo=<?php echo htmlspecialchars($dizimo['id_dizimo']); ?>">
                                      <img src="../../imagens/diversas_imagens/download.png" width="25" height="20">
                                    </a>
                               </td>
                               <td>
                        <a href="tela_alterar_dizimo.php?id_dizimo=<?php echo htmlspecialchars($dizimo['id_dizimo']); ?>">
                            <img src="../../imagens/diversas_imagens/editar.png" width="25" height="20">
                        </a>
                    </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Total:</strong> R$ <?= number_format($totalSum, 2, ',', '.') ?></p>
            </div>
            <div class="col-md-6">
                <ul class="pagination">
                    <?php
                    $maxLinks = 5;
                    $start = max(1, $paginaAtual - $maxLinks);
                    $end = min($totalPaginas, $paginaAtual + $maxLinks);

                    if ($paginaAtual > 1) {
                        echo "<li class='page-item'><a class='page-link' href='?pagina=1&congregacao=$congregacaoFiltro&data=$dataFiltro'>Primeiro</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaAtual - 1) . "&congregacao=$congregacaoFiltro&data=$dataFiltro'>Anterior</a></li>";
                    }

                    for ($pagina = $start; $pagina <= $end; $pagina++) {
                        $active = ($pagina == $paginaAtual) ? "active" : "";
                        echo "<li class='page-item $active'><a class='page-link' href='?pagina=$pagina&congregacao=$congregacaoFiltro&data=$dataFiltro'>$pagina</a></li>";
                    }

                    if ($paginaAtual < $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaAtual + 1) . "&congregacao=$congregacaoFiltro&data=$dataFiltro'>Próximo</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?pagina=$totalPaginas&congregacao=$congregacaoFiltro&data=$dataFiltro'>Último</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function filtrarPorData() {
            const dataFiltro = document.getElementById('dataFiltro').value;
            const congregacao = document.getElementById('congregacao') ? document.getElementById('congregacao').value : '';
            window.location.href = `?data=${dataFiltro}&congregacao=${congregacao}`;
        }

        function filtrarPorDataECongregacao() {
            const dataFiltro = document.getElementById('dataFiltro').value;
            const congregacao = document.getElementById('congregacao').value;
            window.location.href = `?data=${dataFiltro}&congregacao=${congregacao}`;
        }
    </script>
</body>

</html>















