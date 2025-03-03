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

require '../../vendor/autoload.php';
use Dompdf\Dompdf;

$pdf = new Dompdf();

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
$html .= '<td colspan="6" style="text-align: center; font-weight: bold;">Relatório de despesa</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>Transação</b></td>';
$html .= '<td><b>Data da Saída</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>Responsável</b></td>';
$html .= '<td><b>Congregação</b></td>';
$html .= '<td><b>Descrição</b></td>';
$html .= '</tr>';

// Inicializa uma variável para rastrear a soma geral de todos os valores
$totalGeral = 0;

// Inicializa um array para armazenar a soma dos valores por congregação e mês
$sumByCongregationAndMonth = [];

// Inicializa uma variável para rastrear o valor total de todas as congregações
$totalTodasCongregacoes = 0;

// Selecionar todos os itens da tabela
$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));
$congregacao = $_SESSION['nome'];

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sql = "SELECT * FROM saidas WHERE datasaida BETWEEN '$data_inicio' AND '$data_fim'";
    $sql = $pdo->query($sql);
} else {
    $sql = "SELECT * FROM saidas WHERE congregacao='$congregacao' AND datasaida BETWEEN '$data_inicio' AND '$data_fim'";
    $sql = $pdo->query($sql);
}

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . $linhas["id"] . '</td>';
        $html .= '<td>' . date("d/m/Y", strtotime($linhas["datasaida"])) . '</td>';
        $html .= '<td>' . $linhas["valor"] . '</td>';
        $html .= '<td>' . $linhas["responsavel"] . '</td>';
        $html .= '<td>' . $linhas["congregacao"] . '</td>';
        $html .= '<td>' . $linhas["descricao"] . '</td>';
        $html .= '</tr>';

        // Obter o mês e o ano da dataCaptura
        $mesAno = date("Y-m", strtotime($linhas["datasaida"]));

        // Inicializar a soma do mês para a congregação se ainda não estiver definida
        if (!isset($sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno])) {
            $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] = 0;
        }

        // Adicionar o valor do item à soma da congregação e do mês correspondente
        $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] += $linhas["valor"];

        // Adicionar o valor do item ao valor total de todas as congregações
        $totalTodasCongregacoes += $linhas["valor"];

        // Atualizar a soma geral
        $totalGeral += $linhas["valor"];
    }
}
$html .= '</table>';

$html .= '<br>';



$html .= '<br>';
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

$html .= '<br>';
$html .= '<p>Total de Todas as Congregações: ' . number_format($totalTodasCongregacoes, 2) . '</p>';

$pdf->loadHtml($html);
$pdf->render();
$pdf->stream('Saidas.pdf', ['Attachment' => false]);
?>





