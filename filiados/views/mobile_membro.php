<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit();
}

require_once '../../db/config.php';

$matricula = $_GET['matricula'] ?? '';
$nome = $_GET['nome'] ?? '';

// Prepare a consulta SQL com placeholders
$sql = "SELECT * FROM filiado WHERE 1=1";

$params = [];
if (!empty($matricula)) {
    $sql .= " AND matricula = :matricula";
    $params[':matricula'] = $matricula;
}
if (!empty($nome)) {
    $sql .= " AND nome LIKE :nome";
    $params[':nome'] = $nome . '%';
}

// Prepare e execute a consulta
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$linhas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificação</title>
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/membro.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>

    <div class="container">
        <?php if (!empty($linhas)): ?>
        <?php foreach ($linhas as $linha): ?>
        <div class="container">
            <div class="card" onclick="flipCard(this)">
                <div class="card-inner">
                    <div class="card-back">
                        <img id ="verso" src="../../imagens/img_carteira/verso_moblie.png" alt="Verso do Cartão">
                        <div class="card-content">
                            <p id="nome"><?php echo htmlspecialchars($linha['nome']); ?></p>
                            <p id="documento">Documento: <?php echo htmlspecialchars($linha['documento']); ?></p>
                            <p id="data_nascimento">Data de Nascimento:
                                <?php echo date("d/m/Y", strtotime($linha['dataNascimento'])); ?></p>
                            <p id="data_batismo">Data de Batismo:
                                <?php echo date("d/m/Y", strtotime($linha['dataBatismo'])); ?></p>
                            <p id="estado_civil">Estado Civil: <?php echo htmlspecialchars($linha['estadoCivil']); ?>
                            </p>
                            <p id="mae">Mãe: <?php echo htmlspecialchars($linha['mae']); ?></p>
                            <p id="pai">Pai: <?php echo htmlspecialchars($linha['pai']); ?></p>
                        </div>
                    </div>
                    <div class="card-front">
                        <img id ="frente" src="../../imagens/img_carteira/frente_mobile.png" alt="Frente do Cartão">
                        <div class="card-content">
                            <p id="matricula"><?php echo htmlspecialchars($linha['matricula']); ?></p>
                            <p id="nome_carteira"><?php echo htmlspecialchars($linha['nome_carteira']); ?></p>
                            <p id="funcao"><?php echo strtoupper(htmlspecialchars($linha['funcao'])); ?></p>
                            <p id="congregacao"><?php echo htmlspecialchars($linha['congregacao']); ?></p>

                        </div>
                        <img id="img_foto" src="../../imagens/<?php echo htmlspecialchars($linha['arquivo']); ?>"
                        alt="Foto" class="rounded-circle">
                    </div>
                </div>
            </div>
        </div>
        <script>
        function flipCard(card) {
            const cardInner = card.querySelector('.card-inner');
            cardInner.style.transform = cardInner.style.transform === 'rotateY(180deg)' ? 'rotateY(0deg)' : 'rotateY(180deg)';
        }

        </script>

        <?php endforeach; ?>
        <?php else: ?>
        <p>Nenhum filiado encontrado.</p>
        <?php endif; ?>
    </div>

    <script>
    var currentImgIndex = 0;
    var ImgSrcArray = [
        '../../carteira/imagens/carteira_obreiro.png'
    ];

    function trocar() {
        currentImgIndex = (currentImgIndex + 1) % ImgSrcArray.length;
        document.getElementById("frente_card").src = ImgSrcArray[currentImgIndex];
    }
    </script>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>