<?php
session_start();
require_once "../../db/config.php";

$response = ['status' => 'error', 'message' => ''];

if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}

// Verifique se a sessão está ativa
if (!isset($_SESSION['nome']) || !isset($_SESSION['nivel'])) {
    $response['message'] = 'Usuário não autenticado.';
    echo json_encode($response);
    exit();
}

// Verifique se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenha os dados do formulário
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $confirmarSenha = isset($_POST['confirmarSenha']) ? $_POST['confirmarSenha'] : '';
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : '';
    $congregacao = isset($_POST['congregacao']) ? $_POST['congregacao'] : '';

    // Valide os dados
    if (empty($matricula) || empty($nome) || empty($senha) || empty($confirmarSenha) || empty($nivel) || empty($congregacao)) {
        $response['message'] = 'Todos os campos são obrigatórios.';
        echo json_encode($response);
        exit();
    }

    // Verifique se as senhas coincidem
    if ($senha !== $confirmarSenha) {
        $response['message'] = 'As senhas não coincidem.';
        echo json_encode($response);
        exit();
    }

    // Criptografe a senha com MD5
    $senhaHash = md5($senha);

    // Prepare a consulta para evitar SQL Injection
    try {
        $sql = "INSERT INTO usuarios (matricula, nome, senha, nivel, congregacao, dataCaptura) VALUES (:matricula, :nome, :senha, :nivel, :congregacao, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':congregacao', $congregacao);

        // Execute a consulta
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Cadastro realizado com sucesso!';
        } else {
            $response['message'] = 'Erro ao realizar o cadastro. Tente novamente!';
        }
    } catch (PDOException $e) {
        $response['message'] = 'Erro: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Método de solicitação inválido.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>







