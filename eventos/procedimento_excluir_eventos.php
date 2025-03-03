<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:../login.php');
    exit();
}

require '../db/config.php'; // Certifique-se de que o arquivo de configuração está correto

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

$response = [
    'success' => false,
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true); // Obtém dados JSON da solicitação
    $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

    if ($id) {
        try {
            $sql = "DELETE FROM eventos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $response['success'] = $stmt->rowCount() > 0;

            if ($response['success']) {
                $response['message'] = 'Evento excluído com sucesso.';
            } else {
                $response['message'] = 'Nenhum evento encontrado com o ID fornecido.';
            }
        } catch (PDOException $e) {
            $response['message'] = 'Erro no banco de dados: ' . htmlspecialchars($e->getMessage());
        }
    } else {
        $response['message'] = 'ID do evento não fornecido.';
    }
} else {
    $response['message'] = 'Método de solicitação inválido.';
}

echo json_encode($response); // Envia a resposta como JSON
?>





