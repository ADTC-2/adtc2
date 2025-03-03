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

    // Receber dados do formulário e sanitizar
    $nome_noiva = strtoupper(trim($_POST['nome_noiva'] ?? ''));
    $cpf_noiva = trim($_POST['cpf_noiva'] ?? '');
    $data_nascimento_noiva = trim($_POST['data_nascimento_noiva'] ?? '');
    $cidade_nascimento_noiva = trim($_POST['cidade_nascimento_noiva'] ?? '');
    $uf_noiva = trim($_POST['uf_noiva'] ?? '');
    $mae_de_noiva = strtoupper(trim($_POST['mae_de_noiva'] ?? ''));
    $pai_de_noiva = strtoupper(trim($_POST['pai_de_noiva'] ?? ''));
 
    $nome_noivo = strtoupper(trim($_POST['nome_noivo'] ?? ''));
    $cpf_noivo = trim($_POST['cpf_noivo'] ?? '');
    $data_nascimento_noivo = trim($_POST['data_nascimento_noivo'] ?? '');
    $cidade_nascimento_noivo = trim($_POST['cidade_nascimento_noivo'] ?? '');
    $uf_noivo = trim($_POST['uf_noivo'] ?? '');
    $maenoivo = strtoupper(trim($_POST['maenoivo'] ?? ''));
    $painoivo = strtoupper(trim($_POST['painoivo'] ?? ''));
   
    $local_celebracao = trim($_POST['local_celebracao'] ?? '');
    $data_celebracao = trim($_POST['data_celebracao'] ?? '');
    $uf_celebracao = trim($_POST['uf_celebracao'] ?? '');
    $ministro = trim($_POST['ministro'] ?? '');
    $data_criacao = date('Y-m-d'); // Define a data atual no formato YYYY-MM-DD

    // Verificar se todos os campos obrigatórios foram preenchidos
    if (empty($nome_noiva) || empty($cpf_noiva) || empty($data_nascimento_noiva) || empty($nome_noivo) || empty($cpf_noivo) || empty($local_celebracao) || empty($data_celebracao)) {
        $response['status'] = 'error';
        $response['message'] = 'Preencha todos os campos obrigatórios.';
        echo json_encode($response);
        exit();
    }

    // Inserir dados no banco de dados
    $sql = 'INSERT INTO casamento (
        nome_noiva, cpf_noiva, data_nascimento_noiva, cidade_nascimento_noiva, uf_noiva,
        mae_de_noiva, pai_de_noiva, nome_noivo, cpf_noivo, 
        data_nascimento_noivo, cidade_nascimento_noivo, uf_noivo, maenoivo, painoivo,
        local_celebracao, data_celebracao, uf_celebracao, ministro, data_criacao
    ) VALUES (
        :nome_noiva, :cpf_noiva, :data_nascimento_noiva, :cidade_nascimento_noiva, :uf_noiva,
        :mae_de_noiva, :pai_de_noiva, :nome_noivo, :cpf_noivo,
        :data_nascimento_noivo, :cidade_nascimento_noivo, :uf_noivo, :maenoivo, :painoivo,
        :local_celebracao, :data_celebracao, :uf_celebracao, :ministro, :data_criacao
    )';
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_noiva', $nome_noiva);
    $stmt->bindParam(':cpf_noiva', $cpf_noiva);
    $stmt->bindParam(':data_nascimento_noiva', $data_nascimento_noiva);
    $stmt->bindParam(':cidade_nascimento_noiva', $cidade_nascimento_noiva);
    $stmt->bindParam(':uf_noiva', $uf_noiva);
    $stmt->bindParam(':mae_de_noiva', $mae_de_noiva);
    $stmt->bindParam(':pai_de_noiva', $pai_de_noiva);
  
    $stmt->bindParam(':nome_noivo', $nome_noivo);
    $stmt->bindParam(':cpf_noivo', $cpf_noivo);
    $stmt->bindParam(':data_nascimento_noivo', $data_nascimento_noivo);
    $stmt->bindParam(':cidade_nascimento_noivo', $cidade_nascimento_noivo);
    $stmt->bindParam(':uf_noivo', $uf_noivo);
    $stmt->bindParam(':maenoivo', $maenoivo);
    $stmt->bindParam(':painoivo', $painoivo);
  
    $stmt->bindParam(':local_celebracao', $local_celebracao);
    $stmt->bindParam(':data_celebracao', $data_celebracao);
    $stmt->bindParam(':uf_celebracao', $uf_celebracao);
    $stmt->bindParam(':ministro', $ministro);
    $stmt->bindParam(':data_criacao', $data_criacao);

    $stmt->execute();

    // Preparar resposta de sucesso
    $response['status'] = 'success';
    $response['message'] = 'Cadastro realizado com sucesso!';
} catch (Exception $e) {
    // Preparar resposta de erro
    $response['status'] = 'error';
    // Não exibir mensagem completa de erro ao usuário em produção
    $response['message'] = 'Erro ao processar o cadastro. Tente novamente mais tarde.';
    // Apenas para debug, remova em produção:
    // $response['error'] = $e->getMessage(); // Exibe a mensagem de erro detalhada
}

// Enviar a resposta JSON
echo json_encode($response);
?>
















