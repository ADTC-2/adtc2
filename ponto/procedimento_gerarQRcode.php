<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {  
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    
    // Redireciona para a página de autenticação
    header('location: login.php');   
    exit;
}

// Verifica se os dados do formulário foram enviados
if (isset($_POST['matricula']) && !empty($_POST['matricula'])) {
    $matricula = addslashes($_POST['matricula']);
    $nome = addslashes($_POST['nome']);
}

// Pasta onde o arquivo será salvo (ajuste o caminho conforme necessário)

// Gera o QR code
require_once 'qrcode/qrlib.php';

// Dados para o QR code (ajuste conforme necessário)
$qrData = "Matrícula: $matricula\nNome: $nome";

// Verifica se o diretório existe, senão cria
if (!file_exists($pasta)) {
    mkdir($pasta, 0755, true);
}

// Caminho completo para o arquivo QR code
$nomeArquivo = time() . '_' . $nome . '.png'; // Adicionei o nome para torná-lo mais único
$caminhoCompleto = $pasta . $nomeArquivo;

// Verifica se o arquivo já existe
while (file_exists($caminhoCompleto)) {
    // Se existir, renomeia adicionando "_repetido" ao nome do arquivo
    $nomeArquivo = time() . '_' . $nome . '_repetido.png';
    $caminhoCompleto = $pasta . $nomeArquivo;
}

// Gera o QR code e salva como imagem
try {
    QRcode::png($qrData, $caminhoCompleto, QR_ECLEVEL_L, 5);

    // Envia o arquivo para o navegador
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($caminhoCompleto) . '"');
    readfile($caminhoCompleto);

    // Encerra o script
    exit;
} catch (Exception $e) {
    // Captura exceção e exibe mensagem de erro
    echo "
        <script type=\"text/javascript\">
            alert(\"Erro ao gerar QR code: " . $e->getMessage() . "\");
            window.location.href = 'buscar.php';
        </script>
    ";
}
?>






