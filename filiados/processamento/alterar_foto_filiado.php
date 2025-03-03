<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('Location: ../login.php');
    exit;
}

require '../../db/config.php';

$matricula = $_POST['matricula'];

// Configurações do upload
$_UP['pasta'] = '../../imagens/';
$_UP['tamanho'] = 1024 * 1024 * 5; // 5MB
$_UP['extensoes'] = ['png', 'jpg', 'jpeg', 'gif'];
$_UP['renomeia'] = true;

// Verifica se houve algum erro com o upload
if ($_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {
    error_log("Erro no upload: " . $_FILES['arquivo']['error']);
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
        <script type='text/javascript'>
            alert('Erro ao fazer upload da imagem.');
        </script>
    ";
    exit;
}

// Faz a verificação da extensão do arquivo
$extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
if (!in_array($extensao, $_UP['extensoes'])) {
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
        <script type='text/javascript'>
            alert('A imagem não foi cadastrada. Extensão inválida.');
        </script>
    ";
    exit;
}

// Verifica o tamanho do arquivo
if ($_FILES['arquivo']['size'] > $_UP['tamanho']) {
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
        <script type='text/javascript'>
            alert('Arquivo muito grande.');
        </script>
    ";
    exit;
}

// Renomeia o arquivo se necessário
$nome_final = $_UP['renomeia'] ? time() . '.' . $extensao : $_FILES['arquivo']['name'];

// Tenta mover o arquivo para o diretório de destino
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
    $arquivo = $nome_final;

    // Usa prepared statements para evitar SQL injection
    $stmt = $pdo->prepare("UPDATE filiado SET arquivo = :arquivo WHERE matricula = :matricula");
    $stmt->bindParam(':arquivo', $arquivo);
    $stmt->bindParam(':matricula', $matricula);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
            <script type='text/javascript'>
                alert('Foto alterada com sucesso.');
            </script>
        ";
    } else {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
            <script type='text/javascript'>
                alert('Foto não foi alterada.');
            </script>
        ";
    }
} else {
    error_log("Falha ao mover o arquivo para o diretório: " . $_UP['pasta']);
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
        <script type='text/javascript'>
            alert('Ocorreu um problema ao salvar a imagem. Tente novamente.');
        </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
</head>
<body>
</body>
</html>

