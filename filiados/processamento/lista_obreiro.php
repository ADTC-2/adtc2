<?php
require_once "../../db/config.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado e se é válido
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha']) || !is_valid_user($_SESSION['nome'], $_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome'], $_SESSION['senha']);
    header('Location: login.php');
    exit();
}

// Verifica se o nível de acesso é "apoio" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] !== 'apoio' && $_SESSION['nivel'] !== 'admin')) {
    header('Location: acesso_negado.php');
    exit();
}

// Função para validar o usuário no banco de dados
function is_valid_user($nome, $senha) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nome = :nome AND senha = :senha");
    $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

// Função para limpar e validar entradas
function clean_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Função para aplicar o filtro de congregação, se necessário
function apply_congregation_filter($sql, &$params) {
    if ($_SESSION['nivel'] === 'apoio') {
        $sql .= " AND congregacao = :congregacao";
        $params[':congregacao'] = $_SESSION['congregacao'];
    }
    return $sql;
}

// Função para obter o total de registros
function get_total_records($pdo) {
    $sql = "SELECT COUNT(*) as total FROM filiado WHERE 1=1";
    $params = [];
    $sql = apply_congregation_filter($sql, $params);

    $stmt = $pdo->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

// Função para obter os registros com base na pesquisa
function get_filtered_records($pdo, $start, $length, $search, $orderColumn, $orderDir) {
    $sql = "SELECT matricula, nome, funcao, arquivo, congregacao FROM filiado WHERE 1=1";
    $params = [];

    $sql = apply_congregation_filter($sql, $params);

    if (!empty($search['value'])) {
        $searchValue = '%' . clean_input($search['value']) . '%';
        $sql .= " AND (nome LIKE :searchValue OR matricula LIKE :searchValue)";
        $params[':searchValue'] = $searchValue;
    }

    // Validação da coluna de ordenação
    $validColumns = ['matricula', 'nome', 'funcao', 'arquivo', 'congregacao'];
    $orderColumn = in_array($orderColumn, $validColumns) ? $orderColumn : 'nome';
    
    // Validação da direção da ordenação
    $orderDir = strtoupper($orderDir) === 'DESC' ? 'DESC' : 'ASC';
    $sql .= " ORDER BY " . $orderColumn . " " . $orderDir;
    $sql .= " LIMIT :start, :length";

    $stmt = $pdo->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':length', $length, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para obter a contagem dos registros filtrados
function get_filtered_records_count($pdo, $search) {
    $sql = "SELECT COUNT(*) as total FROM filiado WHERE 1=1";
    $params = [];

    $sql = apply_congregation_filter($sql, $params);

    if (!empty($search['value'])) {
        $searchValue = '%' . clean_input($search['value']) . '%';
        $sql .= " AND (nome LIKE :searchValue OR matricula LIKE :searchValue)";
        $params[':searchValue'] = $searchValue;
    }

    $stmt = $pdo->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

// Configuração do DataTables
$start = isset($_POST['start']) ? (int)$_POST['start'] : 0;
$length = isset($_POST['length']) ? (int)$_POST['length'] : 10;
$search = isset($_POST['search']) ? $_POST['search'] : [];
$orderColumnIndex = isset($_POST['order'][0]['column']) ? (int)$_POST['order'][0]['column'] : 0;
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

// Mapeamento dos índices de colunas para nomes reais
$columns = ['matricula', 'nome', 'funcao', 'arquivo', 'congregacao'];
$orderColumn = $columns[$orderColumnIndex] ?? 'nome';

// Obter o total de registros e registros filtrados
$totalRecords = get_total_records($pdo);
$filteredRecords = get_filtered_records($pdo, $start, $length, $search, $orderColumn, $orderDir);
$filteredTotalRecords = get_filtered_records_count($pdo, $search);

// Preparar a resposta
$response = [
    'draw' => isset($_POST['draw']) ? (int)$_POST['draw'] : 1,
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $filteredTotalRecords,
    'data' => $filteredRecords
];

// Enviar a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>



