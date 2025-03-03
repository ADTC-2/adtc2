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

header('Content-Type: application/json');

$response = array();

try {

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receber dados do formulário
    $data_reuniao = date('Y-m-d'); // Define a data atual no formato YYYY-MM-DD
    $local = trim($_POST['local']);
    $tipo = trim($_POST['tipo']);
    $conteudo = trim($_POST['conteudo']);

    // Validar os dados
    if (empty($local) || empty($tipo) || empty($conteudo)) {
        throw new Exception('Todos os campos são obrigatórios.');
    }

    // Inserir dados no banco de dados
    $sql = 'INSERT INTO ata (data_reuniao, local, tipo, conteudo) VALUES (:data_reuniao, :local, :tipo, :conteudo)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':data_reuniao', $data_reuniao);
    $stmt->bindParam(':local', $local);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->execute();

    // Preparar resposta de sucesso
    $response['status'] = 'success';
    $response['message'] = 'Cadastro realizado com sucesso!';
} catch (Exception $e) {
    // Preparar resposta de erro
    $response['status'] = 'error';
    $response['message'] = 'Erro ao processar o cadastro: ' . $e->getMessage();
}

// Enviar a resposta JSON
echo json_encode($response);
?>


