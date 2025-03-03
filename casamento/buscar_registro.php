<?php
// Inicia a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conectar ao banco de dados usando PDO
require_once '../db/config.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit();
}

// Verifica se o nível de acesso é "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    // Redireciona para uma página de acesso negado
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Acesso negado']);
    exit();
}

// Consulta os dados dos casamentos usando PDO
try {
    $sql = "SELECT id, nome_noivo, nome_noiva FROM casamento";
    $stmt = $pdo->query($sql);

    // Inicializa um array para armazenar os dados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Define o tipo de conteúdo como JSON
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $data
    ]);
} catch (PDOException $e) {
    // Caso ocorra um erro na consulta
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Erro na consulta ao banco de dados']);
}

// Fechar a conexão PDO
$pdo = null;
?>






