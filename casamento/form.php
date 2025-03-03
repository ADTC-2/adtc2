<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

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
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Cadastro de Registro de Casamento</h1>
            </div>
            <div class="card-body">
                <form id="form-casamento">
                    <!-- Dados da Noiva -->
                    <div class="form-section">
                        <h2>Dados da Noiva</h2>
                        <div class="mb-3">
                            <label for="nome_noiva" class="form-label">Nome da Noiva</label>
                            <input type="text" class="form-control" id="nome_noiva" name="nome_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf_noiva" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_noiva" name="cpf_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento_noiva" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento_noiva" name="data_nascimento_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade_nascimento_noiva" class="form-label">Naturalidade</label>
                            <input type="text" class="form-control" id="cidade_nascimento_noiva" name="cidade_nascimento_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_noiva" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_noiva" name="uf_noiva" maxlength="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="mae_de_noiva" class="form-label">Mãe</label>
                            <input type="text" class="form-control" id="mae_de_noiva" name="mae_de_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="pai_de_noiva" class="form-label">Pai</label>
                            <input type="text" class="form-control" id="pai_de_noiva" name="pai_de_noiva" required>
                        </div>
                    </div>

                    <!-- Dados do Noivo -->
                    <div class="form-section">
                        <h2>Dados do Noivo</h2>
                        <div class="mb-3">
                            <label for="nome_noivo" class="form-label">Nome do Noivo</label>
                            <input type="text" class="form-control" id="nome_noivo" name="nome_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf_noivo" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_noivo" name="cpf_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento_noivo" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento_noivo" name="data_nascimento_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade_nascimento_noivo" class="form-label">Naturalidade</label>
                            <input type="text" class="form-control" id="cidade_nascimento_noivo" name="cidade_nascimento_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_noivo" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_noivo" name="uf_noivo" maxlength="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="mae_de_noivo" class="form-label">Mãe</label>
                            <input type="text" class="form-control" id="mae_de_noivo" name="maenoivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="pai_de_noivo" class="form-label">Pai</label>
                            <input type="text" class="form-control" id="pai_de_noivo" name="painoivo" required>
                        </div>
                    </div>

                    <!-- Dados da Cerimônia -->
                    <div class="form-section">
                        <h2>Dados da Cerimônia</h2>
                        <div class="mb-3">
                            <label for="local_celebracao" class="form-label">Local da Celebração</label>
                            <input type="text" class="form-control" id="local_celebracao" name="local_celebracao" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_celebracao" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data_celebracao" name="data_celebracao" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_celebracao" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_celebracao" name="uf_celebracao" maxlength="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="ministro" class="form-label">Ministro</label>
                            <input type="text" class="form-control" id="ministro" name="ministro" required>
                        </div>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="text-center">
                        <div class="d-inline-block">
                            <button type="button" id="btn-salvar" class="btn btn-success">Salvar Registro</button>
                        </div>
                        <div class="d-inline-block" style="margin-left: 10px;">
                            <a href="listar.php" class="btn btn-primary">Lista Registros</a>
                        </div>
                        <div class="d-inline-block" style="margin-left: 10px;">
                            <button class="btn btn-warning" onclick="goBack()">Voltar</button>
                        </div>
                    </div>
                </form>
                <br>
                <!-- Container para os alertas -->
                <div id="alerta-container"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.getElementById('btn-salvar').addEventListener('click', function() {
    // Limpa qualquer alerta anterior
    var alertContainer = document.getElementById('alerta-container');
    alertContainer.innerHTML = '';

    // Coleta os dados do formulário
    var form = document.getElementById('form-casamento');
    var formData = new FormData(form);

    // Envia os dados para o servidor
    fetch('salvar_registro.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor:', data); // Adicione este log para depuração

        if (data.status === 'success') {
            // Exibe o alerta de sucesso
            var alertSuccess = document.createElement('div');
            alertSuccess.className = 'alert alert-success';
            alertSuccess.textContent = 'Registro salvo com sucesso!';
            alertContainer.appendChild(alertSuccess);

            // Limpa o formulário
            form.reset();
        } else {
            // Exibe o alerta de erro
            var alertError = document.createElement('div');
            alertError.className = 'alert alert-danger';
            alertError.textContent = 'Ocorreu um erro ao salvar o registro: ' + data.message;
            alertContainer.appendChild(alertError);
        }
    }).catch(error => {
        // Exibe o alerta de erro em caso de falha na requisição
        var alertError = document.createElement('div');
        alertError.className = 'alert alert-danger';
        alertError.textContent = 'Ocorreu um erro ao processar a requisição.';
        alertContainer.appendChild(alertError);
    });
});
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

