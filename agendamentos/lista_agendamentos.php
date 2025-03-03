<?php
session_start();

if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Finaliza o script para garantir que a página não seja renderizada
}

require_once "../db/config.php";

// Parâmetros da paginação
$porPagina = isset($_POST['length']) ? intval($_POST['length']) : 5; // Quantidade de resultados por página
$inicio = isset($_POST['start']) ? intval($_POST['start']) : 0; // Índice inicial

// Parâmetros de ordenação
$colunaOrdenacao = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$direcaoOrdenacao = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';
$colunas = ['id', 'solicitante', 'tipo_evento', 'horario', 'data_evento', 'telefone', 'situacao', 'dataAgendamento'];
$colunaOrdenacao = $colunas[$colunaOrdenacao];

// Parâmetros de busca
$busca = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Consulta total de registros sem filtros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM agendamento")->fetchColumn();

// Consulta com filtros, busca e ordenação
$sql = "SELECT * FROM agendamento WHERE 
        id LIKE :busca OR
        solicitante LIKE :busca OR
        tipo_evento LIKE :busca OR
        horario LIKE :busca OR
        data_evento LIKE :busca OR
        telefone LIKE :busca OR
        situacao LIKE :busca OR
        dataAgendamento LIKE :busca
        ORDER BY $colunaOrdenacao $direcaoOrdenacao
        LIMIT :inicio, :porPagina";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':busca', '%' . $busca . '%', PDO::PARAM_STR);
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':porPagina', $porPagina, PDO::PARAM_INT);
$stmt->execute();

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta total de registros após a filtragem
$sqlFiltros = "SELECT COUNT(*) FROM agendamento WHERE 
        id LIKE :busca OR
        solicitante LIKE :busca OR
        tipo_evento LIKE :busca OR
        horario LIKE :busca OR
        data_evento LIKE :busca OR
        telefone LIKE :busca OR
        situacao LIKE :busca OR
        dataAgendamento LIKE :busca";

$stmtFiltros = $pdo->prepare($sqlFiltros);
$stmtFiltros->bindValue(':busca', '%' . $busca . '%', PDO::PARAM_STR);
$stmtFiltros->execute();
$totalRegistrosFiltrados = $stmtFiltros->fetchColumn();

// Retorna os dados no formato JSON
echo json_encode([
    "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 1, // Número de solicitações enviadas pelo DataTables
    "recordsTotal" => $totalRegistros, // Total de registros no banco de dados
    "recordsFiltered" => $totalRegistrosFiltrados, // Total de registros após a filtragem
    "data" => $dados // Dados a serem exibidos na tabela
]);
?>

