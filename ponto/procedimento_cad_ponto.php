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

if (isset($_POST['matricula']) && !empty($_POST['matricula'])) {
    $matricula = addslashes($_POST['matricula']);
    $nome = addslashes($_POST['nome']);
    $funcao = addslashes($_POST['funcao']);
    $congregacao = addslashes($_POST['congregacao']);


    // Verifica se a matrícula já existe
    $consultaMatricula = $pdo->prepare("SELECT COUNT(*) as total FROM ponto WHERE matricula = :matricula");
    $consultaMatricula->bindValue(':matricula', $matricula);
    $consultaMatricula->execute();
    $result = $consultaMatricula->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        echo "
            <script type=\"text/javascript\">
                alert(\"Matrícula já cadastrada. Não é permitido cadastrar a mesma matrícula mais de uma vez.\");
                window.location.href = 'buscar.php';
            </script>
        ";
        exit;
    }
    
    
    $arquivo = $_FILES['arquivo'];
    
    // Pasta onde o arquivo será salvo
    $pasta = '../ponto/img_qrcode/';
    
    // Tamanho máximo do arquivo em Bytes (100 MB)
    $tamanhoMaximo = 100 * 1024 * 1024;
    
    // Extensões permitidas
    $extensoesPermitidas = array('png', 'jpg', 'jpeg', 'gif', 'pdf', 'xls', 'doc', 'xlsx', 'xlsm', 'docx', 'txt', 'pptx');
    
    // Verifica se houve algum erro com o upload
    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        die("Não foi possível fazer o upload, erro: <br />" . $_UP['erros'][$arquivo['error']]);
    }
    
    // Verifica a extensão do arquivo
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extensao, $extensoesPermitidas)) {
        echo "
            <script type=\"text/javascript\">
                alert(\"O arquivo não foi cadastrado. Extensão inválida.\");
                window.location.href = 'buscar.php';
            </script>
        ";
        exit;
    }
    
    // Verifica o tamanho do arquivo
    if ($arquivo['size'] > $tamanhoMaximo) {
        echo "
            <script type=\"text/javascript\">
                alert(\"Arquivo muito grande.\");
                window.location.href = 'buscar.php';
            </script>
        ";
        exit;
    }
    
    // Gera um nome único para o arquivo
    $nomeArquivo = time() . '_' . $arquivo['name'];
    
    // Move o arquivo para a pasta
    if (move_uploaded_file($arquivo['tmp_name'], $pasta . $nomeArquivo)) {
        // Inserção no banco de dados
        $data = date('Y-m-d');
        $sql = "INSERT INTO ponto(matricula,nome,funcao, congregacao, dataCadastro, arquivo)
                VALUES ('$matricula', '$nome', '$funcao','$congregacao', '$data', '$nomeArquivo')";
        
        if ($pdo->exec($sql)) {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Qrcode do filiado cadastrado com sucesso.\");
                    window.location.href = 'buscar.php';
                </script>
            ";
        } else {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Qrcode do filiado não foi cadastrado.\");
                    window.location.href = 'buscar.php';
                </script>
            ";
        }
    } else {
        echo "
            <script type=\"text/javascript\">
                alert(\"Erro ao fazer o upload do arquivo.\");
                window.location.href = 'buscar.php';
            </script>
        ";
    }
}
?>