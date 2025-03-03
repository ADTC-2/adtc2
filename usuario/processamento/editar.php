<?php
session_start();
require_once "../../db/config.php";

if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o 'id' está definido
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID do usuário não fornecido.']);
        exit();
    }

    $id = trim($_POST['id']);
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $nivel = isset($_POST['nivel']) ? trim($_POST['nivel']) : '';
    $congregacao = isset($_POST['congregacao']) ? trim($_POST['congregacao']) : '';
    $matricula = isset($_POST['matricula']) ? trim($_POST['matricula']) : '';

    // Verifica se os dados são válidos
    if (empty($nome) || empty($nivel) || empty($congregacao) || empty($matricula)) {
        echo json_encode(['success' => false, 'message' => 'Nome, nível, congregação e matrícula são obrigatórios.']);
        exit();
    }

    // Se a senha não estiver vazia, atualize-a
    if (!empty($senha)) {
        $senhaHash = md5($senha); // Criptografa a senha com MD5
        $query = 'UPDATE usuarios SET nome = :nome, senha = :senha, nivel = :nivel, congregacao = :congregacao, matricula = :matricula WHERE id = :id';
        $params = [
            'nome' => $nome,
            'senha' => $senhaHash,
            'nivel' => $nivel,
            'congregacao' => $congregacao,
            'matricula' => $matricula,
            'id' => $id
        ];
    } else {
        // Se a senha estiver vazia, não atualize-a
        $query = 'UPDATE usuarios SET nome = :nome, nivel = :nivel, congregacao = :congregacao, matricula = :matricula WHERE id = :id';
        $params = [
            'nome' => $nome,
            'nivel' => $nivel,
            'congregacao' => $congregacao,
            'matricula' => $matricula,
            'id' => $id
        ];
    }

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar os dados: ' . $e->getMessage()]);
    }
}
?>




