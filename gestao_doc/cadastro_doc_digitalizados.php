<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:../login.php');
    exit;
}

require '../db/config.php';

if (isset($_POST['descricao']) && !empty($_POST['descricao'])) {
    $descricao = addslashes($_POST['descricao']);
    $tipo = addslashes($_POST['tipo']);
    $responsavel = addslashes($_POST['responsavel']);
    
    $arquivo = $_FILES['arquivo'];
    
    $pasta = '../gestao_doc/documentos/Digitalizados/';
    
    $tamanhoMaximo = 100 * 1024 * 1024;
    
    $extensoesPermitidas = array('png', 'jpg', 'jpeg', 'gif', 'pdf', 'xls', 'doc', 'xlsx', 'xlsm', 'docx', 'txt', 'pptx');
    
    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        die("Não foi possível fazer o upload, erro: <br />" . $_UP['erros'][$arquivo['error']]);
    }
    
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extensao, $extensoesPermitidas)) {
        echo "O arquivo não foi cadastrado. Extensão inválida.";
        exit;
    }
    
    if ($arquivo['size'] > $tamanhoMaximo) {
        echo "Arquivo muito grande.";
        exit;
    }
    
    $nomeArquivo = time() . '_' . $arquivo['name'];
    
    if (move_uploaded_file($arquivo['tmp_name'], $pasta . $nomeArquivo)) {
        $data = date('Y-m-d');
        $sql = "INSERT INTO  docdigitalizados (descricao, tipo, responsavel, dataCadastro, arquivo)
                VALUES ('$descricao', '$tipo', '$responsavel', '$data', '$nomeArquivo')";
        
        if ($pdo->exec($sql)) {
            echo "Documento cadastrado com sucesso.";
        } else {
            echo "Documento não foi cadastrado.";
        }
    } else {
        echo "Erro ao fazer o upload do arquivo.";
    }
}
?>





