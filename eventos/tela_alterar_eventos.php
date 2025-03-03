<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

require '../db/config.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    $evento = $stmt->fetch();
}

if (!$evento) {
    header('Location: tela_lista_eventos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Editar Evento</title>
    <style>
        body {
            padding-top: 20px;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-block {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a href="tela_cadastro.php" class="navbar-brand">Eventos ADTC2</a>
</nav>
<div class="container">
    <form novalidate class="needs-validation" action="procedimento_alterar_eventos.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($evento['id']); ?>">
        <div class="form-row">
            <div class="col form-group">
                <label for="evento">Evento</label>
                <input type="text" name="evento" class="form-control" id="evento" value="<?php echo htmlspecialchars($evento['evento']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="anotacoes">Anotações</label>
                <textarea name="anotacoes" class="form-control" id="anotacoes" required><?php echo htmlspecialchars($evento['anotacoes']); ?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="congregacao">Congregação</label>
                <select class="form-control" id="congregacao" name="congregacao" required>
                    <?php
                    $congregacoes = [
                        'SEDE', 'ALEGRIA', 'JUBAIA', 'LAGES', 'NOVO MARANGUAPE 1', 'NOVO MARANGUAPE 2', 
                        'NOVO MARANGUAPE 3', 'NOVO MARANGUAPE 4', 'OUTRA BANDA', 'PARQUE SÃO JOÃO', 
                        'NOVO PARQUE IRACEMA', 'SITIO SÃO LUIZ', 'TABATINGA', 'UMARIZEIRAS', 'VITÓRIA', 
                        'VIÇOSA', 'PAPARA', 'PLANALTO', 'SERRA JUBAIA', 'IRACEMA', 'PARAISO', 'CASTELO', 
                        'LAMEIRÃO'
                    ];
                    foreach ($congregacoes as $congregacao_option) {
                        $selected = $evento['congregacao'] == $congregacao_option ? 'selected' : '';
                        echo "<option value=\"$congregacao_option\" $selected>$congregacao_option</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="dt_evento">Data do Evento</label>
                <input type="date" name="dt_evento" class="form-control" id="dt_evento" value="<?php echo htmlspecialchars($evento['dt_evento']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="situacao">Status</label>
                <input type="text" name="situacao" class="form-control" id="situacao" value="<?php echo htmlspecialchars($evento['situacao']); ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Alterar</button>
        <a href="tela_lista_eventos.php" class="btn btn-info btn-block">Listar Eventos</a>
        <a href="tela_relatorio_eventos.php" class="btn btn-primary btn-block">Relatório</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

