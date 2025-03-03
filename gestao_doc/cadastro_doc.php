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

if (isset($_POST['descricao']) && !empty($_POST['descricao'])) {
    $descricao = htmlspecialchars($_POST['descricao'], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
    $responsavel = htmlspecialchars($_POST['responsavel'], ENT_QUOTES, 'UTF-8');
    
    // Pasta onde o arquivo será salvo
    $pasta = '../gestao_doc/documentos/';

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
            $data = date('Y-m-d');
            $sql = "INSERT INTO documentos (descricao, tipo, responsavel, dataCadastro, arquivo)
                    VALUES (:descricao, :tipo, :responsavel, :dataCadastro, :arquivo)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([
                ':descricao' => $descricao,
                ':tipo' => $tipo,
                ':responsavel' => $responsavel,
                ':dataCadastro' => $data,
                ':arquivo' => $nomeArquivo
            ])) {
                echo "
                    <script type=\"text/javascript\">
                        alert(\"Documento cadastrado com sucesso.\");
                        window.location.href = 'gestao_doc_cadastro.php';
                    </script>
                ";
            } else {
                echo "
                    <script type=\"text/javascript\">
                        alert(\"Documento não foi cadastrado.\");
                        window.location.href = 'gestao_doc_cadastro.php';
                    </script>
                ";
            }
        } else {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Erro ao mover o arquivo.\");
                    window.location.href = 'tela_upload_modelos.php';
                </script>
            ";
        }
    } else {
        echo "
            <script type=\"text/javascript\">
                alert(\"Nenhum arquivo foi enviado ou ocorreu um erro no upload.\");
                window.location.href = 'tela_upload_modelos.php';
            </script>
        ";
    }
} else {
    echo "
        <script type=\"text/javascript\">
            alert(\"Descrição não pode estar vazia.\");
            window.location.href = 'tela_upload_modelos.php';
        </script>
    ";
}
?>





