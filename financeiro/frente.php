<?php
session_start();
include 'verifica_acesso.php';
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
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

// Selecionar todos os itens da tabela
$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sqlDizimo = "SELECT * FROM dizimo WHERE dataCaptura BETWEEN :data_inicio AND :data_fim";
} else {
    $sqlDizimo = "SELECT * FROM dizimo WHERE congregacao=:congregacao AND dataCaptura BETWEEN :data_inicio AND :data_fim";
}

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sqlOfertas = "SELECT * FROM ofertas WHERE dataOferta BETWEEN :data_inicio AND :data_fim";
} else {
    $sqlOfertas = "SELECT * FROM ofertas WHERE congregacao=:congregacao AND dataOferta BETWEEN :data_inicio AND :data_fim";
}

$stmtDizimo = $pdo->prepare($sqlDizimo);
$stmtDizimo->bindParam(':data_inicio', $data_inicio);
$stmtDizimo->bindParam(':data_fim', $data_fim);
if ($congregacao !== "Alves" && $congregacao !== "Marcos") {
    $stmtDizimo->bindParam(':congregacao', $congregacao);
}
$stmtDizimo->execute();
$dizimos = $stmtDizimo->fetchAll(PDO::FETCH_ASSOC);

$stmtOfertas = $pdo->prepare($sqlOfertas);
$stmtOfertas->bindParam(':data_inicio', $data_inicio);
$stmtOfertas->bindParam(':data_fim', $data_fim);
if ($congregacao !== "Alves" && $congregacao !== "Marcos") {
    $stmtOfertas->bindParam(':congregacao', $congregacao);
}
$stmtOfertas->execute();
$ofertas = $stmtOfertas->fetchAll(PDO::FETCH_ASSOC);

$totalDizimos = 0;
foreach ($dizimos as $dizimo) {
    $totalDizimos += $dizimo['valor'];
}

$totalOfertas = 0;
foreach ($ofertas as $oferta) {
    $totalOfertas += $oferta['valor'];
}

$totalGeral = $totalDizimos + $totalOfertas;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        @media print {
            #botao {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Relatório de Caixa</h1>
        <hr>

        <!-- Total Geral -->
        <div class="card mb-4">
            <div class="card-header">
                Total Geral
                <span class="float-right"><?php echo date('d/m/Y'); ?></span>
            </div>
            <div class="card-body">
                <p class="text-right"><strong>Total Geral:</strong> R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Dízimos -->
        <div class="card mb-4">
            <div class="card-header">
                Dízimos
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Nome</th>
                                <th>Congregação</th>
                                <th>Valor</th>
                                <th>Responsável</th>
                                <th>Data de Lançamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($stmtDizimo->rowCount() > 0) {
                                foreach ($dizimos as $dizimo) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($dizimo["id_dizimo"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($dizimo["nome"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($dizimo["congregacao"]) . '</td>';
                                    echo '<td>R$ ' . number_format($dizimo['valor'], 2, ',', '.') . '</td>';
                                    echo '<td>' . htmlspecialchars($dizimo["responsavel"]) . '</td>';
                                    echo '<td>' . date("d/m/Y", strtotime($dizimo["dataCaptura"])) . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <p class="text-right"><strong>Total Dízimos:</strong> R$ <?php echo number_format($totalDizimos, 2, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Ofertas -->
        <div class="card mb-4">
            <div class="card-header">
                Ofertas
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Congregação</th>
                                <th>Responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($stmtOfertas->rowCount() > 0) {
                                foreach ($ofertas as $oferta) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($oferta["id_ofertas"]) . '</td>';
                                    echo '<td>' . date("d/m/Y", strtotime($oferta["dataOferta"])) . '</td>';
                                    echo '<td>R$ ' . number_format($oferta['valor'], 2, ',', '.') . '</td>';
                                    echo '<td>' . htmlspecialchars($oferta["congregacao"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($oferta["responsavel"]) . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <p class="text-right"><strong>Total Ofertas:</strong> R$ <?php echo number_format($totalOfertas, 2, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Total de Dízimos e Ofertas por Congregação -->
        <div class="card mb-4">
            <div class="card-header">
                Total de Dízimos e Ofertas por Congregação
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Congregação</th>
                            <th>Total Dízimos</th>
                            <th>Total Ofertas</th>
                            <th>Total Dízimos e Ofertas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Array para armazenar os totais por congregação
                        $totalPorCongregacao = array();

                        // Calcular totais por congregação para Dízimos
                        foreach ($dizimos as $dizimo) {
                            $congregacao = htmlspecialchars($dizimo["congregacao"]);
                            $valorDizimo = isset($totalPorCongregacao[$congregacao]['dizimos']) ? $totalPorCongregacao[$congregacao]['dizimos'] : 0;
                            $valorDizimo += $dizimo['valor'];
                            $totalPorCongregacao[$congregacao]['dizimos'] = $valorDizimo;
                        }

                        // Calcular totais por congregação para Ofertas
                        foreach ($ofertas as $oferta) {
                            $congregacao = htmlspecialchars($oferta["congregacao"]);
                            $valorOferta = isset($totalPorCongregacao[$congregacao]['ofertas']) ? $totalPorCongregacao[$congregacao]['ofertas'] : 0;
                            $valorOferta += $oferta['valor'];
                            $totalPorCongregacao[$congregacao]['ofertas'] = $valorOferta;
                        }

                        // Exibir os totais na tabela
                        foreach ($totalPorCongregacao as $congregacao => $totais) {
                            $totalDizimos = isset($totais['dizimos']) ? $totais['dizimos'] : 0;
                            $totalOfertas = isset($totais['ofertas']) ? $totais['ofertas'] : 0;
                            $totalDizimosOfertas = $totalDizimos + $totalOfertas;
                            echo '<tr>';
                            echo '<td>' . $congregacao . '</td>';
                            echo '<td>R$ ' . number_format($totalDizimos, 2, ',', '.') . '</td>';
                            echo '<td>R$ ' . number_format($totalOfertas, 2, ',', '.') . '</td>';
                            echo '<td>R$ ' . number_format($totalDizimosOfertas, 2, ',', '.') . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botões -->
        <div class="mt-4">
            <a id="botao" href="../financeiro/dizimo/lancamentos.php" class="btn btn-primary mr-2">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <button id="imprimir" class="btn btn-success" onclick="imprimir()">Imprimir</button>
            <a id="compartilhar" href="https://api.whatsapp.com/send?text=<?php echo urlencode('Confira o relatório de caixa: Total Geral: R$ ' . number_format($totalGeral, 2, ',', '.')); ?>"
                class="btn btn-primary">
                <i class="fas fa-share-alt"></i> Compartilhar
            </a>
            <button id="download" class="btn btn-info" onclick="downloadHTML()">Download HTML</button>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function isMobileDevice() {
            return /Mobi|Android/i.test(navigator.userAgent);
        }

        function downloadHTML() {
            var htmlContent = document.documentElement.outerHTML;
            var blob = new Blob([htmlContent], {
                type: 'text/html'
            });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'relatorio.html';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        window.onload = function () {
            if (isMobileDevice()) {
                document.getElementById('imprimir').style.display = 'none';
                document.getElementById('compartilhar').style.display = 'none';
                document.getElementById('download').style.display = 'block';
            } else {
                document.getElementById('download').style.display = 'none';
            }
        }

        function imprimir() {
            window.print();
        }
    </script>
</body>

</html>


