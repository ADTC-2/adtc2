<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado e tem nível adequado
if (!isset($_SESSION['nome']) || !isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
    exit();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        $id = intval($_POST['id']); // Sanitização básica do ID

        // Conectar ao banco de dados
        require '../db/config.php'; 

        try {
            // Prepara a query para excluir a reunião
            $stmt = $pdo->prepare('DELETE FROM casamento WHERE id = ?');
            if ($stmt->execute([$id])) {
                // Retorna sucesso em formato JSON
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Falha ao excluir o registro.']);
            }
        } catch (PDOException $e) {
            // Retorna erro em formato JSON
            echo json_encode(['success' => false, 'error' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID inválido ou não fornecido.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método inválido.']);
}
?>




