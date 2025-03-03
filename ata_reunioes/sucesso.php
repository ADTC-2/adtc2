<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Sucesso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            if ($msg == 'success') {
                echo '<div class="alert alert-success" role="alert">Ata cadastrada com sucesso!</div>';
            } elseif ($msg == 'error') {
                echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar ata. Por favor, tente novamente.</div>';
            }
        }
        ?>
        <a href="./cadastro.php" class="btn btn-primary mt-3">Voltar ao Cadastro</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
