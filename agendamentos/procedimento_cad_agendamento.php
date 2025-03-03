<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();

    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:../login.php');
    exit;
}

require '../db/config.php';

if (isset($_POST['solicitante']) && !empty($_POST['solicitante'])) {
    $solicitante  = addslashes($_POST['solicitante']);
    $tipo_evento  = addslashes($_POST['tipo_evento']);
    $horario      = addslashes($_POST['horario']);
    $data_evento  = addslashes($_POST['data_evento']);
    $telefone     = addslashes($_POST['telefone']);
    
        $situacao        = "reservado";
        $data            = date('Y-m-d');
        $sql = "INSERT INTO agendamento(solicitante,tipo_evento,horario,data_evento,telefone,situacao,dataAgendamento)
                VALUES ('$solicitante','$tipo_evento','$horario','$data_evento','$telefone','$situacao','$data')";
        
        if ($pdo->exec($sql)) {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Agendamento Realizado com  sucesso.\");
                    window.location.href = '../agendamentos/tela_cadastro.php';
                </script>
            ";
        } else {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Agendamento não realizado.\");
                    window.location.href = '../agendamentos/tela_cadastro.php';
                </script>
            ";
        }
    } 
?>