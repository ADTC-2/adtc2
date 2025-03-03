<?php
require_once "../../db/config.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome'], $_SESSION['senha']);
    header('Location: login.php');
    exit();
}

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] !== 'apoio' && $_SESSION['nivel'] !== 'admin')) {
    header('Location: acesso_negado.php');
    exit();
}


// Função para limpar e validar entradas
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Função para obter o total de registros
function get_total_records($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM filiado");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

// Função para obter os registros com base na pesquisa
function get_filtered_records($pdo, $start, $length, $search, $orderColumn, $orderDir) {
    $sql = "SELECT matricula, nome, funcao, arquivo,congregacao FROM filiado WHERE 1=1";
    $params = [];

    if (!empty($search['value'])) {
        $searchValue = '%' . clean_input($search['value']) . '%';
        $sql .= " AND (nome LIKE :searchValue OR matricula LIKE :searchValue)";
        $params[':searchValue'] = $searchValue;
    }

    $orderColumn = preg_match('/^[a-zA-Z0-9_]+$/', $orderColumn) ? $orderColumn : 'nome'; // Valida a coluna de ordenação
    $orderDir = strtoupper($orderDir) === 'DESC' ? 'DESC' : 'ASC'; // Valida a direção da ordenação
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
    
    if (!empty($search['value'])) {
        $searchValue = '%' . clean_input($search['value']) . '%';
        $sql .= " AND (nome LIKE :searchValue OR matricula LIKE :searchValue)";
    }

    $stmt = $pdo->prepare($sql);

    if (!empty($search['value'])) {
        $stmt->bindValue(':searchValue', $searchValue, PDO::PARAM_STR);
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
$columns = ['matricula', 'nome', 'funcao', 'arquivo'];
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


