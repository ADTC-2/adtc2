<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome'], $_SESSION['senha']);
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    $_SESSION['error_message'] = "Acesso negado! Você precisa ser um administrador para acessar esta página.";
    header('Location: acesso_negado.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../db/config.php';

    // Recebe os dados do formulário
    $id = intval($_POST['id']);
    $nome_noiva = strtoupper(trim(htmlspecialchars($_POST['nome_noiva'], ENT_QUOTES, 'UTF-8')));
    $cpf_noiva = strtoupper(trim(htmlspecialchars($_POST['cpf_noiva'], ENT_QUOTES, 'UTF-8')));
    $data_nascimento_noiva = trim($_POST['data_nascimento_noiva']);
    $cidade_nascimento_noiva = strtoupper(trim(htmlspecialchars($_POST['cidade_nascimento_noiva'], ENT_QUOTES, 'UTF-8')));
    $uf_noiva = strtoupper(trim(htmlspecialchars($_POST['uf_noiva'], ENT_QUOTES, 'UTF-8')));
    $mae_de_noiva = strtoupper(trim(htmlspecialchars($_POST['mae_de_noiva'], ENT_QUOTES, 'UTF-8')));
    $pai_de_noiva = strtoupper(trim(htmlspecialchars($_POST['pai_de_noiva'], ENT_QUOTES, 'UTF-8')));

    $nome_noivo = strtoupper(trim(htmlspecialchars($_POST['nome_noivo'], ENT_QUOTES, 'UTF-8')));
    $cpf_noivo = strtoupper(trim(htmlspecialchars($_POST['cpf_noivo'], ENT_QUOTES, 'UTF-8')));
    $data_nascimento_noivo = trim($_POST['data_nascimento_noivo']);
    $cidade_nascimento_noivo = strtoupper(trim(htmlspecialchars($_POST['cidade_nascimento_noivo'], ENT_QUOTES, 'UTF-8')));
    $uf_noivo = strtoupper(trim(htmlspecialchars($_POST['uf_noivo'], ENT_QUOTES, 'UTF-8')));
    $maenoivo = strtoupper(trim(htmlspecialchars($_POST['maenoivo'], ENT_QUOTES, 'UTF-8')));
    $painoivo = strtoupper(trim(htmlspecialchars($_POST['painoivo'], ENT_QUOTES, 'UTF-8')));

    $local_celebracao = strtoupper(trim(htmlspecialchars($_POST['local_celebracao'], ENT_QUOTES, 'UTF-8')));
    $data_celebracao = trim($_POST['data_celebracao']);
    $uf_celebracao = strtoupper(trim(htmlspecialchars($_POST['uf_celebracao'], ENT_QUOTES, 'UTF-8')));
    $ministro = strtoupper(trim(htmlspecialchars($_POST['ministro'], ENT_QUOTES, 'UTF-8')));

    
    // Query para atualizar os dados
    $query = "UPDATE casamento SET 
        nome_noiva = :nome_noiva,
        cpf_noiva = :cpf_noiva,
        data_nascimento_noiva = :data_nascimento_noiva,
        cidade_nascimento_noiva = :cidade_nascimento_noiva,
        uf_noiva = :uf_noiva,
        mae_de_noiva = :mae_de_noiva,
        pai_de_noiva = :pai_de_noiva,
        nome_noivo = :nome_noivo,
        cpf_noivo = :cpf_noivo,
        data_nascimento_noivo = :data_nascimento_noivo,
        cidade_nascimento_noivo = :cidade_nascimento_noivo,
        uf_noivo = :uf_noivo,
        maenoivo = :maenoivo,
        painoivo = :painoivo,
        local_celebracao = :local_celebracao,
        data_celebracao = :data_celebracao,
        uf_celebracao = :uf_celebracao,
        ministro = :ministro      
        WHERE id = :id";

    $stmt = $pdo->prepare($query);

    // Bind dos parâmetros
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':nome_noiva', $nome_noiva);
    $stmt->bindValue(':cpf_noiva', $cpf_noiva);
    $stmt->bindValue(':data_nascimento_noiva', $data_nascimento_noiva);
    $stmt->bindValue(':cidade_nascimento_noiva', $cidade_nascimento_noiva);
    $stmt->bindValue(':uf_noiva', $uf_noiva);
    $stmt->bindValue(':mae_de_noiva', $mae_de_noiva);
    $stmt->bindValue(':pai_de_noiva', $pai_de_noiva);
    $stmt->bindValue(':nome_noivo', $nome_noivo);
    $stmt->bindValue(':cpf_noivo', $cpf_noivo);
    $stmt->bindValue(':data_nascimento_noivo', $data_nascimento_noivo);
    $stmt->bindValue(':cidade_nascimento_noivo', $cidade_nascimento_noivo);
    $stmt->bindValue(':uf_noivo', $uf_noivo);
    $stmt->bindValue(':maenoivo', $maenoivo);
    $stmt->bindValue(':painoivo', $painoivo);
    $stmt->bindValue(':local_celebracao', $local_celebracao);
    $stmt->bindValue(':data_celebracao', $data_celebracao);
    $stmt->bindValue(':uf_celebracao', $uf_celebracao);
    $stmt->bindValue(':ministro', $ministro);    

    // Executa a query
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Registro de casamento alterado com sucesso!";
        header('Location: listar.php');
        exit();
    } else {
        echo "Erro ao atualizar o registro!";
    }
}
?>



