<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();

    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('Location: ../login.php');
    exit;
}

require '../db/config.php'; // Verifique se o arquivo de configuração do banco de dados está correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o formulário foi enviado via POST

    $evento = isset($_POST['evento']) ? $_POST['evento'] : '';
    $anotacoes = isset($_POST['anotacoes']) ? $_POST['anotacoes'] : '';
    $congregacao = isset($_POST['congregacao']) ? $_POST['congregacao'] : '';
    $dt_evento = isset($_POST['dt_evento']) ? $_POST['dt_evento'] : '';

    if (!empty($evento) && !empty($congregacao) && !empty($dt_evento)) {        
        // Verifica se o evento já existe no banco de dados
        $existingEventQuery = "SELECT COUNT(*) FROM servico WHERE evento = ? AND dt_evento = ?";
        $stmtExistingEvent = $pdo->prepare($existingEventQuery);
        $stmtExistingEvent->execute([$evento, $dt_evento]);
        $count = $stmtExistingEvent->fetchColumn();

        if ($count == 0) {
            // O evento não existe, podemos inseri-lo
            try {
                $sql = "INSERT INTO servico (evento, anotacoes, congregacao, dt_evento) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$evento, $anotacoes, $congregacao, $dt_evento]);

                // Redireciona com uma mensagem de sucesso
                echo "<script>alert('Serviço cadastrado com sucesso.');</script>";
                echo "<script>window.location.href = '../servico/tela_cadastro.php';</script>";
                exit;
            } catch (PDOException $e) {
                // Lidar com erros no banco de dados
                echo "Erro no banco de dados: " . $e->getMessage();
            }
        } else {
            // Evento já cadastrado
            echo "<script>alert('Evento já cadastrado.');</script>";
            echo "<script>window.location.href = '../servico/tela_cadastro.php';</script>";
            exit;
        }
    } else {
        // Campos obrigatórios não preenchidos
        echo "<script>alert('Preencha todos os campos obrigatórios.');</script>";
        echo "<script>window.location.href = '../servico/tela_cadastro.php';</script>";
        exit;
    }
}
?>



