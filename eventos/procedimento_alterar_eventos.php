<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('Location: ../login.php');
    exit();
}

require '../db/config.php';

$id = $_POST['id'];
$evento = $_POST['evento'];
$anotacoes = $_POST['anotacoes'];
$congregacao = $_POST['congregacao'];
$dt_evento = $_POST['dt_evento'];
$situacao = $_POST['situacao'];

$sql = "UPDATE eventos SET evento = :evento, anotacoes = :anotacoes, congregacao = :congregacao, dt_evento = :dt_evento, situacao = :situacao WHERE id = :id";
$statement = $pdo->prepare($sql);
$success = $statement->execute([
    'evento' => $evento,
    'anotacoes' => $anotacoes,
    'congregacao' => $congregacao,
    'dt_evento' => $dt_evento,
    'situacao' => $situacao,
    'id' => $id
]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Resultado da Alteração</title>
</head>
<body>
    <div class="container mt-5">
        <?php if ($success): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> Evento alterado com sucesso.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php else: ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> O evento não foi alterado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <a href="tela_lista_eventos.php" class="btn btn-info">Listar Eventos</a>
        <a href="tela_relatorio_eventos.php" class="btn btn-primary">Relatório</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



