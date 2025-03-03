<?php
session_start();

require_once "../../db/config.php";
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Excluir o usuário
    $query = 'DELETE FROM usuarios WHERE id = :id';
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    // Retornar uma resposta
    echo json_encode(['status' => 'success']);
}
?>
