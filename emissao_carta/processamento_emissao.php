<?php
session_start();
require '../db/config.php';

// Inicializa um array para armazenar a resposta
$response = array();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Define a resposta de erro e termina o script
    $response['success'] = false;
    $response['message'] = "Usuário não autenticado";
    echo json_encode($response);
    exit();
}



if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $estadocivil = addslashes($_POST['estadocivil']);
    $cidade = addslashes($_POST['cidade']);
    $funcao = addslashes($_POST['funcao']);
    $status = addslashes($_POST['status']);

    $data = date('Y-m-d');
    $sql = "INSERT INTO emitir(nome,estadocivil,cidade,funcao,status,dataCaptura)
            VALUES ('$nome','$estadocivil','$cidade','$funcao','$status','$data')";

    if ($pdo->exec($sql)) {
        $response['success'] = true;
        $response['message'] = "Dados da carta lançados com sucesso.";
    } else {
        $response['success'] = false;
        $response['message'] = "Emissão da carta não realizado.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Campos obrigatórios não preenchidos";
}

// Retorna a resposta como JSON
echo json_encode($response);
?>

