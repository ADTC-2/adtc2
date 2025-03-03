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


require '../../vendor/autoload.php'; // Certifique-se de que o caminho para o arquivo do DomPDF esteja correto

use Dompdf\Dompdf;

// Crie um novo objeto Dompdf com as opções
$pdf = new Dompdf();

// Crie o conteúdo HTML do PDF
$html = '';
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
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Relatório de Ofertas</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>Transação</b></td>';
$html .= '<td><b>Data</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>Congregação</b></td>';
$html .= '<td><b>Responsavel</b></td>';
$html .= '</tr>';

// Inicializa uma variável para rastrear a soma geral de todos os valores
$totalGeral = 0;

// Inicializa um array para armazenar a soma dos valores por congregação e mês
$sumByCongregationAndMonth = [];

// Inicializa um array para armazenar os totais por mês
$totalPorMes = [];

// Validação e filtragem de dados de entrada
$data_inicio = isset($_GET['data_inicio']) ? date('Y-m-d', strtotime($_GET['data_inicio'])) : null;
$data_fim = isset($_GET['data_fim']) ? date('Y-m-d', strtotime($_GET['data_fim'])) : null;
$congregacao = $_SESSION['nome'];

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sql = "SELECT * FROM ofertas WHERE dataOferta BETWEEN '$data_inicio' AND '$data_fim'";
    $sql = $pdo->query($sql);
} else {
    $sql = "SELECT * FROM ofertas WHERE congregacao='$congregacao' AND dataOferta BETWEEN '$data_inicio' AND '$data_fim'";
    $sql = $pdo->query($sql);
}

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . $linhas["id_ofertas"] . '</td>';
        $html .= '<td>' . date("d/m/Y", strtotime($linhas["dataOferta"])) . '</td>';
        $html .= '<td>' . $linhas["valor"] . '</td>';
        $html .= '<td>' . $linhas["congregacao"] . '</td>';
        $html .= '<td>' . $linhas["responsavel"] . '</td>';
        $html .= '</tr>';

        // Obtenha o mês e o ano da dataOferta
        $mesAno = date("Y-m", strtotime($linhas["dataOferta"]));

        // Inicialize a soma do mês para a congregação se ainda não estiver definida
        if (!isset($sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno])) {
            $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] = 0;
        }

        // Adicione o valor do item à soma da congregação e do mês correspondente
        $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] += $linhas["valor"];

        // Atualize a soma geral
        $totalGeral += $linhas["valor"];

        // Atualize o total por mês
        if (!isset($totalPorMes[$mesAno])) {
            $totalPorMes[$mesAno] = 0;
        }
        $totalPorMes[$mesAno] += $linhas["valor"];
    }
}

$html .= '</table>';

$html .= '<br>';



$html .= '<br>';

// Adicionar uma tabela para mostrar a soma por congregação e mês
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<th>Congregação</th>';
$html .= '<th>Mês</th>';
$html .= '<th>Total</th>';
$html .= '</tr>';

foreach ($sumByCongregationAndMonth as $congregacao => $meses) {
    foreach ($meses as $mesAno => $total) {
        list($ano, $mes) = explode('-', $mesAno);
        $html .= '<tr>';
        $html .= '<td>' . $congregacao . '</td>';
        $html .= '<td>' . date("M Y", strtotime($mesAno . '-01')) . '</td>';
        $html .= '<td>' . number_format($total, 2) . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

// Carregue o HTML no Dompdf
$pdf->loadHtml($html);

// Renderize o PDF
$pdf->render();

// Saída do PDF como um arquivo para download
$pdf->stream('Relatorio_de_Ofertas.pdf', ['Attachment' => false]);
?>







