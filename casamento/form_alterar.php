<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit();
}

// Verifica se o nível de acesso é "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    // Redireciona para uma página de acesso negado
    header('Location: acesso_negado.php');
    exit();
}

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexão ao banco de dados
    require '../db/config.php';// Substitua pelo arquivo que realiza a conexão ao banco de dados

    // Query para buscar os dados com base no ID
    $query = "SELECT * FROM casamento WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se encontrou o registro
    if ($registro) {
        // Registro encontrado, siga com o processo
    } else {
        echo "Registro não encontrado!";
        exit;
    }
} else {
    echo "ID não fornecido!";
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Registro de Casamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Alterar Registro de Casamento</h1>
            </div>
            <div class="card-body">
                <form id="form-casamento" method="POST" action="alterar.php">
                    <!-- Campo oculto para armazenar o ID -->
                    <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">

                    <!-- Dados da Noiva -->
                    <div class="form-section">
                        <h2>Dados da Noiva</h2>
                        <div class="mb-3">
                            <label for="nome_noiva" class="form-label">Nome da Noiva</label>
                            <input type="text" class="form-control" id="nome_noiva" name="nome_noiva" value="<?php echo $registro['nome_noiva']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf_noiva" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_noiva" name="cpf_noiva" value="<?php echo $registro['cpf_noiva']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento_noiva" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento_noiva" name="data_nascimento_noiva" value="<?php echo $registro['data_nascimento_noiva']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade_nascimento_noiva" class="form-label">Naturalidade</label>
                            <input type="text" class="form-control" id="cidade_nascimento_noiva" name="cidade_nascimento_noiva" value="<?php echo $registro['cidade_nascimento_noiva']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_noiva" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_noiva" name="uf_noiva" maxlength="2" value="<?php echo $registro['uf_noiva']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="mae_de_noiva" class="form-label">Mãe</label>
                            <input type="text" class="form-control" id="mae_de_noiva" name="mae_de_noiva" value="<?php echo $registro['mae_de_noiva']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pai_de_noiva" class="form-label">Pai</label>
                            <input type="text" class="form-control" id="pai_de_noiva" name="pai_de_noiva" value="<?php echo $registro['pai_de_noiva']; ?>" required>
                        </div>
                    </div>

                    <!-- Dados do Noivo -->
                    <div class="form-section">
                        <h2>Dados do Noivo</h2>
                        <div class="mb-3">
                            <label for="nome_noivo" class="form-label">Nome do Noivo</label>
                            <input type="text" class="form-control" id="nome_noivo" name="nome_noivo" value="<?php echo $registro['nome_noivo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf_noivo" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_noivo" name="cpf_noivo" value="<?php echo $registro['cpf_noivo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento_noivo" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento_noivo" name="data_nascimento_noivo" value="<?php echo $registro['data_nascimento_noivo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade_nascimento_noivo" class="form-label">Naturalidade</label>
                            <input type="text" class="form-control" id="cidade_nascimento_noivo" name="cidade_nascimento_noivo" value="<?php echo $registro['cidade_nascimento_noivo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_noivo" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_noivo" name="uf_noivo" maxlength="2" value="<?php echo $registro['uf_noivo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="mae_de_noivo" class="form-label">Mãe</label>
                            <input type="text" class="form-control" id="maenoivo" name="maenoivo" value="<?php echo $registro['maenoivo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pai_de_noivo" class="form-label">Pai</label>
                            <input type="text" class="form-control" id="painoivo" name="painoivo" value="<?php echo $registro['painoivo']; ?>" required>
                        </div>
                    </div>

                    <!-- Dados da Cerimônia -->
                    <div class="form-section">
                        <h2>Dados da Cerimônia</h2>
                        <div class="mb-3">
                            <label for="local_celebracao" class="form-label">Local da Celebração</label>
                            <input type="text" class="form-control" id="local_celebracao" name="local_celebracao" value="<?php echo $registro['local_celebracao']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_celebracao" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data_celebracao" name="data_celebracao" value="<?php echo $registro['data_celebracao']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_celebracao" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_celebracao" name="uf_celebracao" maxlength="2" value="<?php echo $registro['uf_celebracao']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="ministro" class="form-label">Ministro</label>
                            <input type="text" class="form-control" id="ministro" name="ministro" value="<?php echo $registro['ministro']; ?>" required>
                        </div>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="text-center">
                        <button type="submit" id="btn-salvar" class="btn btn-success">Alterar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>