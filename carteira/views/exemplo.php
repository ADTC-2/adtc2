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
    <link rel="stylesheet" href="../css/carteira_obreiro.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            color: #333;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }
        #foto img {
            border-radius: 50%;
            border: 5px solid #fff;
        }
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .card div {
            margin: 0.5rem 0;
        }
        .card h2, .card p {
            margin: 0;
            text-align: center;
        }
        .hide-on-print {
            display: none;
        }
        @media print {
            .container {
                box-shadow: none;
            }
            .hide-on-print {
                display: none;
            }
            .navbar {
                display: none;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">Identificação</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="window.print();">
                    <i class="fas fa-print"></i> Imprimir
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="history.back();">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <?php if (!empty($linhas)): ?>
        <?php foreach ($linhas as $linha): ?>
            <div class="card_verso">
                <img id="frente_card" src="../../imagens/diversas_imagens/_frente_cracha_novo.png" alt="Carteira">
                <div>
                    <p><?php echo htmlspecialchars($linha['nome']); ?></p>
                    <p>Data de Consagração: <?php echo date("d/m/Y", strtotime($linha['data_Consagracao'])); ?></p>
                    <p>Documento: <?php echo htmlspecialchars($linha['documento']); ?></p>
                    <p>Data de Nascimento: <?php echo date("d/m/Y", strtotime($linha['dataNascimento'])); ?></p>
                    <p>Data de Batismo: <?php echo date("d/m/Y", strtotime($linha['dataBatismo'])); ?></p>
                    <p>Estado Civil: <?php echo htmlspecialchars($linha['estadoCivil']); ?></p>
                    <p>Mãe: <?php echo htmlspecialchars($linha['mae']); ?></p>
                    <p>Pai: <?php echo htmlspecialchars($linha['pai']); ?></p>
                </div>
            <div class="card_frente"> 
            <img id="frente_card" src="../../imagens/img_carteira/verso.png"  alt="Carteira">   
                <div>
                    <p>Matrícula: <?php echo htmlspecialchars($linha['matricula']); ?></p>
                    <p>Nome da Carteira: <?php echo htmlspecialchars($linha['nome_carteira']); ?></p>
                    <p>Função: <?php echo strtoupper(htmlspecialchars($linha['funcao'])); ?></p>
                    <p>Congregação: <?php echo htmlspecialchars($linha['congregacao']); ?></p>
                </div>
                <div id="foto">
                    <img id="img_foto" src="../../imagens/<?php echo htmlspecialchars($linha['arquivo']); ?>" alt="Foto">
                </div>
            </div>
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

</body>

</html>
