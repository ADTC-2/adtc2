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


require '../../db/config.php';

// Verifica se os dados necessários foram recebidos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_dizimo'])) {
    // Sanitização e validação das entradas
    $id_dizimo   = filter_input(INPUT_POST, 'id_dizimo', FILTER_SANITIZE_NUMBER_INT);
    $nome        = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $congregacao = filter_input(INPUT_POST, 'congregacao', FILTER_SANITIZE_STRING);
    $valor       = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
    $responsavel = filter_input(INPUT_POST, 'responsavel', FILTER_SANITIZE_STRING);
    $dataCaptura = filter_input(INPUT_POST, 'dataCaptura', FILTER_SANITIZE_STRING);

    // Prepara a consulta SQL para evitar injeção de SQL
    $sql = "UPDATE dizimo SET nome = :nome, congregacao = :congregacao, valor = :valor, responsavel = :responsavel, dataCaptura = :dataCaptura WHERE id_dizimo = :id_dizimo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_dizimo', $id_dizimo, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
    $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
    $stmt->bindParam(':responsavel', $responsavel, PDO::PARAM_STR);
    $stmt->bindParam(':dataCaptura', $dataCaptura, PDO::PARAM_STR);

    // Executa a consulta e trata o resultado
    if ($stmt->execute()) {
        $message = "Dizimo alterado com Sucesso.";
    } else {
        $message = "Dizimo não foi alterado.";
    }
} else {
    $message = "Dados inválidos.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;URL=tela_lista_dizimo.php?id_dizimo=<?php echo $congregacao; ?>">
    <script type="text/javascript">
        alert("<?php echo $message; ?>");
    </script>
</head>
<body>
</body>
</html>
