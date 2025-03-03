<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado e tem nível adequado
if (!isset($_SESSION['nome']) || !isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    echo json_encode(['error' => 'Acesso negado']);
    exit();
}

require_once '../db/config.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 10;
$offset = ($page - 1) * $items_per_page;

try {
    $stmt = $pdo->prepare("SELECT * FROM ata LIMIT :offset, :items_per_page");
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':items_per_page', $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt_total = $pdo->query("SELECT COUNT(*) as total FROM ata");
    $total_rows = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
    $total_pages = ceil($total_rows / $items_per_page);

    echo json_encode([
        'data' => $data,
        'total_pages' => $total_pages
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao acessar o banco de dados']);
}
?>







