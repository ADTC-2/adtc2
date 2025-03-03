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

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

require '../../db/config.php';

$id_dizimo = $_GET['id_dizimo'];

$sql = "SELECT * FROM dizimo WHERE id_dizimo = '$id_dizimo' LIMIT 1";
$result = $pdo->query($sql);
$linhas = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <title>Comprovante de Dízimo</title>
</head>
<body>
<style>
    @media print {
        nav {
            display: none;
        }
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    .comprovante {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .comprovante-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .comprovante-header img {
        max-width: 150px;
        margin-bottom: 10px;
    }

    .comprovante-header h4 {
        font-size: 1.5em;
        margin: 0;
    }

    .comprovante-header p {
        font-size: 0.9em;
        color: #6c757d;
        margin: 5px 0;
    }

    .comprovante-details {
        font-size: 1em;
        line-height: 1.6;
        color: #212529;
    }

    .comprovante-details p {
        margin: 5px 0;
    }

    .comprovante-details strong {
        color: #343a40;
    }

    .comprovante-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.85em;
        color: #6c757d;
    }

    .comprovante-footer p {
        margin: 0;
    }
</style>

<nav>
    <a href="#" onclick="window.print();" style="text-decoration:none;">
        <p id="texto_imprimir"><?php echo rand(1, 10) . "   |  " . "Imprimir"; ?></p>
    </a>
    <a href="../dizimo/lancamentos.php" class="navbar-brand"><i class="fas fa-arrow-left"></i></a>
</nav>

<div class="comprovante">
    <div class="comprovante-header">
        <img src="../../imagens/diversas_imagens/logAdtcII.png" alt="Logo">
        <h4>Comprovante de Dízimos</h4>
        <p>Rua Coronel Antônio Botelho de Sousa, s/n, Parque Iracema, Maranguape - CE</p>
        <p>Telefone: (00) 99999-9999 | Email: contato@maranguapecombr.com.com</p>
    </div>

    <div class="comprovante-details">
        <p><strong>Recebemos de:</strong> <?php echo $linhas['nome']; ?> ,</p>
        <p><strong>cpf ___________________________,</p>
        <p><strong>na data </strong> <?php echo date("d/m/Y", strtotime($linhas['dataCaptura'])); ?></p>        
        <p><strong>o valor de : </strong> R$ <?php echo number_format($linhas['valor'], 2, ',', '.'); ?></p>
        <p><strong>entregue ao(a) responsável pela tesouraria o(a) ,</strong> <?php echo $linhas['responsavel']; ?></p>
        <p><strong>ofertado na congregação:</strong> <?php echo $linhas['congregacao']; ?></p>
    </div>

    <div class="comprovante-footer">
        <p>Este é um comprovante oficial emitido pela Igreja Evangélica Assembleia de Deus.</p>
        <p>Templo Central II - Maranguape - CE.</p>
        <p>CNPJ:44.588.989/0001-71</p>

        <p>Agradecemos a sua fidelidade e contribuição.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>