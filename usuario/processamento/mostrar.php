<?php
session_start();
require_once "../../db/config.php";

header('Content-Type: application/json');

if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}

$id = $_GET['id'] ?? '';
if ($id) {
    $user = getUserById($id);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'Usuário não encontrado.']);
    }
} else {
    echo json_encode(['error' => 'ID não fornecido.']);
}

function getUserById($id) {
    global $pdo; // Usa a variável global $pdo para a conexão com o banco de dados

    try {
        $stmt = $pdo->prepare("SELECT nome, nivel,congregacao,matricula FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Você pode querer registrar o erro em um log em vez de exibi-lo ao usuário
        return null;
    }
}

?>