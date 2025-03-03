<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
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



require '../../db/config.php';

$porPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';
$dataFiltro = isset($_GET['dataFiltro']) ? $_GET['dataFiltro'] : '';

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM dizimo")->fetchColumn();
$totalPaginas = ceil($totalRegistros / $porPagina);
$indiceInicio = ($paginaAtual - 1) * $porPagina;

function getDizimoQuery($pdo, $indiceInicio, $porPagina, $congregacao = '', $dataFiltro = '') {
    if ($dataFiltro) {
        $sql = "SELECT * FROM dizimo WHERE DATE(dataCaptura) = :dataFiltro LIMIT $indiceInicio, $porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }

    if ($congregacao === "Alves" || $congregacao === "Marcos") {
        return $pdo->query("SELECT * FROM dizimo LIMIT $indiceInicio, $porPagina");
    } else {
        $sql = "SELECT * FROM dizimo WHERE congregacao = :congregacao LIMIT $indiceInicio, $porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }
}

$query = getDizimoQuery($pdo, $indiceInicio, $porPagina, $congregacao, $dataFiltro);

// Monta o array de dados conforme o formato esperado pelo DataTables
$resultados = array(
    "draw" => intval($_GET['draw']),
    "recordsTotal" => $totalRegistros,
    "recordsFiltered" => $totalRegistros,
    "data" => array()
);

foreach ($query as $linha) {
    $row = array();
    $row[] = $linha['id_dizimo'];
    $row[] = $linha['nome'];
    $row[] = $linha['congregacao'];
    $row[] = 'R$ ' . number_format($linha['valor'], 2, ',', '.');
    $row[] = date("d/m/Y", strtotime($linha['dataCaptura']));
    $row[] = "<a href='procedimento_excluir_dizimo.php?id_dizimo={$linha['id_dizimo']}'><img src='../../imagens/diversas_imagens/excluir.png' width='25' height='20'></a>";
    $row[] = "<a href='tela_alterar_dizimo.php?id_dizimo={$linha['id_dizimo']}'><img src='../../imagens/diversas_imagens/editar.png' width='25' height='20'></a>";
    $row[] = "<a href='tela_comprovante_dizimo.php?id_dizimo={$linha['id_dizimo']}'><img src='../../imagens/diversas_imagens/download.png' width='25' height='20'></a>";
    $resultados['data'][] = $row;
}

// Retorna os resultados como JSON
echo json_encode($resultados);
?>

