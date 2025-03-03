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

// Variável para armazenar a mensagem do alerta
$alerta = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletar os dados enviados via POST
    $nome_noiva = $_POST['nome_noiva'];
    $cpf_noiva = $_POST['cpf_noiva'];
    $data_nascimento_noiva = $_POST['data_nascimento_noiva'];
    $cidade_nascimento_noiva = $_POST['cidade_nascimento_noiva'];
    $uf_noiva = $_POST['uf_noiva'];
    $mae_de_noiva = $_POST['mae_de_noiva'];
    $pai_de_noiva = $_POST['pai_de_noiva'];
    $nome_noivo = $_POST['nome_noivo'];
    $cpf_noivo = $_POST['cpf_noivo'];
    $data_nascimento_noivo = $_POST['data_nascimento_noivo'];
    $cidade_nascimento_noivo = $_POST['cidade_nascimento_noivo'];
    $uf_noivo = $_POST['uf_noivo'];
    $mae_de_noivo = $_POST['mae_de_noivo'];
    $pai_de_noivo = $_POST['pai_de_noivo'];
    $local_celebracao = $_POST['local_celebracao'];
    $data_celebracao = $_POST['data_celebracao'];
    $uf_celebracao = $_POST['uf_celebracao'];
    $ministro = $_POST['ministro'];

    // Capturar a data e hora atuais
    $data_criacao = date('Y-m-d H:i:s');

    try {
        // Criar uma nova conexão PDO
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar o comando SQL para inserir os dados na tabela 'casamento'
        $sql = "INSERT INTO casamento (nome_noiva, cpf_noiva, data_nascimento_noiva, cidade_nascimento_noiva, uf_noiva, mae_de_noiva, pai_de_noiva, nome_noivo, cpf_noivo, data_nascimento_noivo, cidade_nascimento_noivo, uf_noivo, mae_de_noivo, pai_de_noivo, local_celebracao, data_celebracao, uf_celebracao, ministro, data_criacao)
                VALUES (:nome_noiva, :cpf_noiva, :data_nascimento_noiva, :cidade_nascimento_noiva, :uf_noiva, :mae_de_noiva, :pai_de_noiva, :nome_noivo, :cpf_noivo, :data_nascimento_noivo, :cidade_nascimento_noivo, :uf_noivo, :mae_de_noivo, :pai_de_noivo, :local_celebracao, :data_celebracao, :uf_celebracao, :ministro, :data_criacao)";

        // Preparar a declaração SQL
        $stmt = $pdo->prepare($sql);

        // Executar a query, ligando os parâmetros
        $stmt->execute([
            ':nome_noiva' => $nome_noiva,
            ':cpf_noiva' => $cpf_noiva,
            ':data_nascimento_noiva' => $data_nascimento_noiva,
            ':cidade_nascimento_noiva' => $cidade_nascimento_noiva,
            ':uf_noiva' => $uf_noiva,
            ':mae_de_noiva' => $mae_de_noiva,
            ':pai_de_noiva' => $pai_de_noiva,
            ':nome_noivo' => $nome_noivo,
            ':cpf_noivo' => $cpf_noivo,
            ':data_nascimento_noivo' => $data_nascimento_noivo,
            ':cidade_nascimento_noivo' => $cidade_nascimento_noivo,
            ':uf_noivo' => $uf_noivo,
            ':mae_de_noivo' => $mae_de_noivo,
            ':pai_de_noivo' => $pai_de_noivo,
            ':local_celebracao' => $local_celebracao,
            ':data_celebracao' => $data_celebracao,
            ':uf_celebracao' => $uf_celebracao,
            ':ministro' => $ministro,
            ':data_criacao' => $data_criacao
        ]);

        // Sucesso ao salvar
        $alerta = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Registro salvo com sucesso!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } catch (PDOException $e) {
        // Exibir erro
        $alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Erro ao salvar o registro: ' . $e->getMessage() . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    }

} else {
    $alerta = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  Método inválido.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
}
?>


