<?php
session_start();
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


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório Dízimos</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <style>
        body { padding-top: 0px; }
        .container { max-width: 800px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="../index_tesoureiro.php" class="navbar-brand"><i class="fas fa-arrow-left"></i> Voltar</a>
    </div>
</nav>

<div class="container mt-4">
    <form class="needs-validation" action="../frente.php" method="GET" novalidate>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="data_inicio" class="form-label">Data inicial</label>
                <input type="date" id="data_inicio" name="data_inicio" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="data_fim" class="form-label">Data final</label>
                <input type="date" id="data_fim" name="data_fim" class="form-control" required>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="congregacao" class="form-label">Congregação</label>
                <select class="form-select" id="congregacao" name="congregacao">
                    <option>Selecione</option>
                    <option>SEDE</option>
                    <option>ALEGRIA</option>
                    <option>JUBAIA</option>
                    <option>LAGES</option>
                    <option>NOVO MARANGUAPE 1</option>
                    <option>NOVO MARANGUAPE 2</option>
                    <option>NOVO MARANGUAPE 3</option>
                    <option>NOVO MARANGUAPE 4</option>
                    <option>OUTRA BANDA</option>
                    <option>PARQUE SÃO JOÃO</option>
                    <option>NOVO PARQUE IRACEMA</option>
                    <option>NOVO PARQUE IRACEMA 2</option>
                    <option>SITIO SÃO LUIZ</option>
                    <option>TABATINGA</option>
                    <option>UMARIZEIRAS</option>
                    <option>VITÓRIA</option>
                    <option>VIÇOSA</option>
                    <option>PAPARA</option>
                    <option>PLANALTO</option>
                    <option>SERRA JUBAIA</option>
                    <option>IRACEMA</option>
                    <option>PARAISO</option>
                    <option>CASTELO</option>
                    <option>LAMEIRÃO</option>
                </select>
            </div>
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Filtrar</button>            
        </div>
    </form>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.needs-validation');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>

</body>
</html>