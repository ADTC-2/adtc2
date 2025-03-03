<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require '../db/config.php';
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
    <title>Buscar Registro de Casamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Buscar Casamento</h1>
        <div id="alerta"></div>
        <form id="buscaCasamentoForm">
            <div class="mb-3">
                <label for="nome_noiva" class="form-label">Nome da Noiva</label>
                <input type="text" class="form-control" id="nome_noiva" name="nome_noiva">
            </div>
            <div class="mb-3">
                <label for="nome_noivo" class="form-label">Nome do Noivo</label>
                <input type="text" class="form-control" id="nome_noivo" name="nome_noivo">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            <div class="d-inline-block" style="margin-left: 10px;">
            <button class="btn btn-warning" onclick="goBack()">Voltar</button>
            </div>
        </form>

        <!-- Onde os resultados serão exibidos -->
        <div id="resultado" class="mt-4"></div>
    </div>

    <script>
        document.getElementById('buscaCasamentoForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            let formData = new FormData(this);
            let alerta = document.getElementById('alerta');

            fetch('buscar_registro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alerta.innerHTML = ''; // Limpa alertas anteriores

                if (data.status === 'success') {
                    // Redireciona para generate.php com os dados recebidos
                    let queryString = new URLSearchParams(data.data).toString();
                    window.location.href = 'generate.php?' + queryString;
                } else {
                    alerta.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                }
            })
            .catch(error => {
                alerta.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Ocorreu um erro ao processar a solicitação. Tente novamente mais tarde.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            });
        });
    </script>
        </script>
        <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
