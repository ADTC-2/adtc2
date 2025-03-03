<?php
session_start();
require '../db/config.php';

// Validação de sessão
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    header('location: ../login.php');
    exit;
}

// Verifica se foi enviado um mês via GET
if (isset($_GET['mes'])) {
    $mes = $_GET['mes'];

    // Query para buscar aniversariantes do mês no banco de dados
    $query = "SELECT nome, congregacao, DATE_FORMAT(dataNascimento, '%Y-%m-%d') as dataNascimento 
              FROM filiado 
              WHERE MONTH(dataNascimento) = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$mes]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os dados como JSON para serem consumidos pelo DataTables
    echo json_encode($result);
    exit;
}


?>
























