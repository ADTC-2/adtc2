<?php
session_start();
include '../db/config.php'; // Inclua a conexão com o banco de dados

$response = array('success' => false);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Certifique-se de que o ID é um número inteiro seguro
    
    $sql = "DELETE FROM cartas WHERE id = :id";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            
            // Redirecionamento para index.php após a exclusão
            header('Location: index.php');
            exit();
        } else {
            $response['error'] = 'Erro ao executar a exclusão.';
        }
    } catch (PDOException $e) {
        $response['error'] = 'Erro ao executar a consulta: ' . $e->getMessage();
    }
}

echo json_encode($response);
?>


