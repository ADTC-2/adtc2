<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:../login.php');
    exit();
}

require '../db/config.php';

$message = '';
$alertClass = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento = addslashes($_POST['evento']);
    $anotacoes = addslashes($_POST['anotacoes']);
    $congregacao = addslashes($_POST['congregacao']);
    $dt_evento = addslashes($_POST['dt_evento']);
    $situacao = 'agendado'; // Definido como fixo no exemplo

    if (!empty($evento) && !empty($congregacao) && !empty($dt_evento)) {
        // Verifica se já existe um evento no mesmo dia
        $existingEventQuery = "SELECT COUNT(*) FROM eventos WHERE dt_evento = ?";
        $stmtExistingEvent = $pdo->prepare($existingEventQuery);
        $stmtExistingEvent->execute([$dt_evento]);
        $count = $stmtExistingEvent->fetchColumn();

        if ($count == 0) {
            try {
                $sql = "INSERT INTO eventos (evento, anotacoes, congregacao, dt_evento, situacao) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$evento, $anotacoes, $congregacao, $dt_evento, $situacao]);
                $success = $stmt->rowCount() > 0;

                if ($success) {
                    $message = 'Evento cadastrado com sucesso.';
                    $alertClass = 'alert-success';
                } else {
                    $message = 'Nenhum evento foi cadastrado.';
                    $alertClass = 'alert-warning';
                }
            } catch (PDOException $e) {
                $message = 'Erro no banco de dados: ' . $e->getMessage();
                $alertClass = 'alert-danger';
            }
        } else {
            $message = 'Já existe um evento agendado para essa data.';
            $alertClass = 'alert-warning';
        }
    } else {
        $message = 'Preencha todos os campos obrigatórios.';
        $alertClass = 'alert-warning';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Resultado do Cadastro</title>
</head>
<body>
    <div class="container mt-5">
        <?php if (!empty($message)): ?>
            <div class="alert <?= $alertClass ?> alert-dismissible fade show" role="alert">
                <strong><?= $success ? 'Sucesso!' : 'Erro!' ?></strong> <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <a href="tela_lista_eventos.php" class="btn btn-info">Listar Eventos</a>
        <a href="tela_relatorio_eventos.php" class="btn btn-primary">Relatório</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




