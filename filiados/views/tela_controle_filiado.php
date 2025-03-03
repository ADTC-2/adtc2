<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Limpa as variáveis de sessão e redireciona para a página de login
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Consulta de Filiados</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-custom {
            margin-top: 50px;
        }
        .form-control, .btn {
            border-radius: 0.5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .header-custom {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-custom hr {
            border-color: #007bff;
            border-width: 2px;
        }
        .input-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container container-custom">
    <div class="header-custom">
        <h1>Consultar Filiados</h1>
        <hr>
    </div>

    <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <form action="../views/tela_resultado_pesquisa_filiado.php" method="POST">
            <div class="input-group mb-3">
                <input name="matricula" id="txt_consulta" placeholder="Digite a Matricula do Filiado" type="text" class="form-control" required>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>

        <form action="../views/tela_resultado_pesquisa_filiado_nome.php" method="POST">
            <div class="input-group mb-3">
                <input name="nome" id="txt_consulta" placeholder="Digite Nome do Filiado" type="text" class="form-control" required>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>

        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</div>


<!-- Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>



</body>
</html>



 