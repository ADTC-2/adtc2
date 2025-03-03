<?php
session_start();
include 'verifica_acesso.php';
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


require '../vendor/dompdf/dompdf';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isPhpEnabled', true);
$pdf = new Dompdf($options);

$pdf->getOptions()->set('title', 'Relatório de Dízimos');

$html = '<!DOCTYPE html>';
$html .= '<html>';
$html .= '<head>';
$html .= '<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>';
$html .= '</head>';
$html .= '<body>';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="6"><b>Relatório de Dízimos</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td><b>Transação</b></td>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td><b>Congregação</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>Responsável</b></td>';
$html .= '<td><b>Data de Lançamento</b></td>';
$html .= '</tr>';

$totalGeral = 0;
$sumByMonth = [];
$sumByCongregation = [];

$data_inicio = isset($_GET['data_inicio']) ? date('Y-m-d', strtotime($_GET['data_inicio'])) : null;
$data_fim = isset($_GET['data_fim']) ? date('Y-m-d', strtotime($_GET['data_fim'])) : null;
$congregacao = isset($_GET['congregacao']) ? filter_input(INPUT_GET, 'congregacao', FILTER_SANITIZE_STRING) : '';

$sql = "SELECT * FROM dizimo WHERE dataCaptura BETWEEN :data_inicio AND :data_fim";
$params = [':data_inicio' => $data_inicio, ':data_fim' => $data_fim];

if (!empty($congregacao) && ($congregacao === "Alves" || $congregacao === "Marcos")) {
    $sql = "SELECT * FROM dizimo WHERE dataCaptura BETWEEN :data_inicio AND :data_fim";
} elseif (!empty($congregacao)) {
    $sql = "SELECT * FROM dizimo WHERE congregacao=:congregacao AND dataCaptura BETWEEN :data_inicio AND :data_fim";
    $params[':congregacao'] = $congregacao;
}

$statement = $pdo->prepare($sql);
$statement->execute($params);

if ($statement->rowCount() > 0) {
    foreach ($statement->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . $linhas["id_dizimo"] . '</td>';
        $html .= '<td>' . $linhas["nome"] . '</td>';
        $html .= '<td>' . $linhas["congregacao"] . '</td>';
        $html .= '<td>' . number_format($linhas['valor'], 2, '.', '.') . '</td>';
        $html .= '<td>' . $linhas["responsavel"] . '</td>';
        $html .= '<td>' . date("d/m/Y", strtotime($linhas["dataCaptura"])) . '</td>';
        $html .= '</tr>';

        $mesAno = date("Y-m", strtotime($linhas["dataCaptura"]));

        if (!isset($sumByMonth[$mesAno])) {
            $sumByMonth[$mesAno] = 0;
        }

        if (!isset($sumByCongregation[$linhas["congregacao"]])) {
            $sumByCongregation[$linhas["congregacao"]] = 0;
        }

        $sumByMonth[$mesAno] += $linhas["valor"];
        $sumByCongregation[$linhas["congregacao"]] += $linhas["valor"];
        $totalGeral += $linhas["valor"];
    }
}

$html .= '</table>';
$html .= '<br>';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<th>Congregação</th>';
$html .= '<th>Mês</th>';
$html .= '<th>Total</th>';
$html .= '</tr>';

foreach ($sumByCongregation as $congregacao => $total) {
    foreach ($sumByMonth as $mesAno => $mesTotal) {
        $mes = date("M", strtotime($mesAno . '-01'));
        $html .= '<tr>';
        $html .= '<td>' . $congregacao . '</td>';
        $html .= '<td>' . $mes . '</td>';
        $html .= '<td>' . number_format($mesTotal, 2, '.', '.') . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';
$html .= '<br>';
$html .= '<p>Total Geral: ' . number_format($totalGeral, 2, '.', '.') . '</p>';

$pdfFilename = 'relatorio_dizimos.pdf';

$pdf->loadHtml($html);
$pdf->render();

// Limpar qualquer saída de buffer antes de enviar cabeçalhos HTTP
ob_clean();

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $pdfFilename . '"');
echo $pdf->output();
