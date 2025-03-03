<?php
session_start();

if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    $nome = $_POST['nome'];
    $senha = md5($_POST['senha']);

    require 'db/config.php';

    $sql = "SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['senha'] = $usuario['senha'];
        $_SESSION['nivel'] = $usuario['nivel'];
        $_SESSION['congregacao'] = $usuario['congregacao'];  
        $_SESSION['matricula'] = $usuario['matricula'];     

        switch ($_SESSION['nivel']) {
            case 'admin':
                echo '<script>window.location.href = "index.php";</script>';
                exit();
            case 'apoio':
                echo '<script>window.location.href = "index_secretario.php";</script>';
                exit();
            case 'financeiro':
                echo '<script>window.location.href = "../adtc2/financeiro/index_tesoureiro.php";</script>';
                exit();
            case 'card':
                echo '<script>window.location.href = "card_member/index.php";</script>';
                exit();
            default:
                echo '<script>window.location.href = "login_erro.php";</script>';
                exit();
        }
        exit();
    } else {
        echo '<script>window.location.href = "login_erro.php";</script>';
        session_destroy();
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        unset($_SESSION['nivel']);
        unset($_SESSION['congregacao']);
        unset($_SESSION['matricula']);       
        exit();
    }
} else {
    echo '<script>window.location.href = "login_erro.php";</script>';
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    unset($_SESSION['nivel']);
    unset($_SESSION['congregacao']); 
    unset($_SESSION['matricula']); 
    exit();
}
?>
