<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

// Define o valor para o campo "congregacao" com base no nome
$congregacao = '';
if ($_SESSION['nome'] == 'Marcos' || $_SESSION['nome'] == 'Alves') {
    $congregacao = $_SESSION['nome'];
} else {
    $congregacao = $_SESSION['congregacao'];
}

// Redireciona para tela_lista_dizimo.php com os parâmetros nome e congregacao
header('Location: tela_lista_dizimo.php?nome=' . urlencode($_SESSION['nome']) . '&congregacao=' . urlencode($congregacao));
exit();
?>



