<?php
session_start();
require '../db/config.php';

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

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');

    // Pasta onde o arquivo será salvo
    $pasta = '../emissao_carta/uploads/';

    // Verifica se o campo de arquivo está presente e não vazio
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == UPLOAD_ERR_OK) {
        $nomeArquivo = basename($_FILES['arquivo']['name']); // Obtém o nome do arquivo
        $caminhoArquivo = $pasta . $nomeArquivo; // Caminho completo do arquivo

        // Verifica se o diretório de upload existe, se não, cria
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        // Move o arquivo enviado para o diretório de upload
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoArquivo)) {
            // Inserção no banco de dados
            $dataEntrega = date('Y-m-d'); // Definindo a data de entrega (exemplo)
            $arquivo = $nomeArquivo; // Apenas o nome do arquivo
            
            $sql = "INSERT INTO cartas (nome, arquivo, dataEntrega)
                    VALUES (:nome, :arquivo, :dataEntrega)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([
                ':nome' => $nome,
                ':arquivo' => $arquivo,
                ':dataEntrega' => $dataEntrega    
            ])) {
                echo "
                    <script type=\"text/javascript\">
                        alert(\"Upload realizado com sucesso.\");
                        window.location.href = 'tela_upload.php';
                    </script>
                ";
            } else {
                echo "
                    <script type=\"text/javascript\">
                        alert(\"Erro ao realizar o upload.\");
                        window.location.href = 'tela_upload.php';
                    </script>
                ";
            }
        } else {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Erro ao mover o arquivo para o diretório de destino.\");
                    window.location.href = 'tela_upload.php';
                </script>
            ";
        }
    } else {
        echo "
            <script type=\"text/javascript\">
                alert(\"Nenhum arquivo foi enviado ou ocorreu um erro no upload.\");
                window.location.href = 'tela_upload.php';
            </script>
        ";
    }
} else {
    echo "
        <script type=\"text/javascript\">
            alert(\"O campo 'nome' não pode estar vazio.\");
            window.location.href = 'tela_upload.php';
        </script>
    ";
}
?>



