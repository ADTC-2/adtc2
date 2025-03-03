<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado e tem nível adequado
if (!isset($_SESSION['nome']) || !isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
    exit();
}

require_once '../db/config.php'; // Certifique-se de que este arquivo contém a configuração da conexão PDO


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $id = $_POST['id']; // Adicione um campo hidden no formulário para o ID
    $nome_noiva = $_POST['nome_noiva'];
    $cpf_noiva = $_POST['cpf_noiva'];
    $data_nascimento_noiva = $_POST['data_nascimento_noiva'];
    // Outros campos...

    // Query de atualização
    $query = "UPDATE registros_casamento SET nome_noiva = ?, cpf_noiva = ?, data_nascimento_noiva = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $nome_noiva, $cpf_noiva, $data_nascimento_noiva, $id);
    
    if ($stmt->execute()) {
        echo "Registro atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar registro.";
    }
}
?>

