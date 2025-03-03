<?php
session_start();

if (!isset($_SESSION['nome']) and !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:../login.php');
}

require '../../db/config.php';

$matricula = $_POST['matricula'];
$nome = $_POST['nome'];
$nome_carteira = $_POST['nome_carteira'];
$funcao = $_POST['funcao'];
$congregacao = $_POST['congregacao'];
$documento = $_POST['documento'];
$dataNascimento = $_POST['dataNascimento'];
$dataBatismo = $_POST['dataBatismo'];
$data_Consagracao = $_POST['data_Consagracao'];
$estadoCivil = $_POST['estadoCivil'];
$mae = $_POST['mae'];
$pai = $_POST['pai'];
$logradouro = $_POST['logradouro'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$telefone = $_POST['telefone'];  
$email = $_POST['email'];
$status = $_POST['status'];
$datCadastro = $_POST['datCadastro'];

// Atualiza os dados do filiado, exceto a foto
$sql = "UPDATE filiado SET nome='$nome', nome_carteira='$nome_carteira', funcao='$funcao', congregacao='$congregacao', documento='$documento', dataNascimento='$dataNascimento', dataBatismo='$dataBatismo', data_Consagracao='$data_Consagracao', estadoCivil='$estadoCivil', mae='$mae', pai='$pai', logradouro='$logradouro', endereco='$endereco', numero='$numero', bairro='$bairro', cep='$cep', cidade='$cidade', uf='$uf', telefone='$telefone', email='$email', status='$status', datCadastro='$datCadastro' WHERE matricula='$matricula'";
$sql = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
</head>
<body>
    <?php
    if ($sql->rowCount() != 0) {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
            <script type='text/javascript'>
                alert('Filiado alterado com sucesso.');
            </script>
        ";
    } else {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.php'>
            <script type='text/javascript'>
                alert('Filiado não foi alterado.');
            </script>
        ";
    }
    ?>
</body>
</html>

