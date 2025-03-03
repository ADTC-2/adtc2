<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['nivel'])) {
    // Redireciona para a página de erro se o usuário não estiver autenticado
    header('Location: login_erro.php');
    exit();
}

// Verifique o nível do usuário
if ($_SESSION['nivel'] !== 'card' && strpos($_SERVER['REQUEST_URI'], 'card_member') !== false) {
    // Redireciona para a página de erro se o usuário não for 'card' e tentar acessar a pasta 'card_member'
    header('Location: acesso_negado.php');
    exit();
}
?>

