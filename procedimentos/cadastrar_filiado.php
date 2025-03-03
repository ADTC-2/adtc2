<?php
session_start();

// Validação de sessão
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    header('location:../login.php');
    exit;
}

require '../db/config.php';

// Validação de entrada
$required_fields = ['nome'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo "<script>alert('Por favor, preencha o campo Nome.'); window.location='../filiados/views/tela_cad_filiado.php';</script>";
        exit;
    }
}

// Prevenção de injeção SQL e verificação de duplicatas
$nome = $_POST['nome'];

$stmt = $pdo->prepare("SELECT * FROM filiado WHERE nome = :nome");
$stmt->execute(['nome' => $nome]);
if ($stmt->rowCount() > 0) {
    echo "<script>alert('Nome já cadastrado!'); window.location='../filiados/views/tela_cad_filiado.php';</script>";
    exit;
}

// Upload de imagem
$default_image_path = '../imagens/vazio.jpg'; // Caminho da imagem padrão
$default_image_name = 'vazio.jpg'; // Nome do arquivo da imagem padrão

// Se um arquivo foi enviado, renomeie-o para o nome padrão
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../imagens/';
    $upload_file = $upload_dir . $default_image_name;
    if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $upload_file)) {
        echo "<script>alert('Erro ao enviar a imagem.'); window.location='../filiados/views/tela_cad_filiado.php';</script>";
        exit;
    }
} else {
    $upload_file = $default_image_path; // Usa o caminho da imagem padrão se nenhum arquivo for enviado
}

// Inserção no banco de dados
$sql = "INSERT INTO filiado (nome, arquivo, datCadastro) VALUES (:nome, :arquivo, NOW())";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nome' => $nome,
    'arquivo' => $default_image_name, // Salva o nome da imagem padrão
]);

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Filiado cadastrado com sucesso.'); window.location='../filiados/views/tela_cad_filiado.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar o filiado.'); window.location='../filiados/views/tela_cad_filiado.php';</script>";
}
?>








