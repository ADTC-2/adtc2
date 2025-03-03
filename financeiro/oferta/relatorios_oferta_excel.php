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

$arquivo = 'Ofertas.xls';

// Configurações header para forçar o download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");

$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="11">Ofertas</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>Transação</b></td>';
$html .= '<td><b>Data</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>Congregação</b></td>';
$html .= '<td><b>Responsável</b></td>';
$html .= '</tr>';

// Inicializa uma variável para rastrear a soma geral de todos os valores
$totalGeral = 0;

// Inicializa um array para armazenar a soma dos valores por congregação e mês
$sumByCongregationAndMonth = [];

// Selecionar todos os itens da tabela
$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));
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
        $html .= '<td>R$ ' . number_format($linhas["valor"], 2, ',', '.') . '</td>';
        $html .= '<td>' . $linhas["congregacao"] . '</td>';
        $html .= '<td>' . $linhas["responsavel"] . '</td>';
        $html .= '</tr>';

        // Obter o mês e o ano da dataOferta
        $mesAno = date("Y-m", strtotime($linhas["dataOferta"]));

        // Inicializar a soma do mês para a congregação se ainda não estiver definida
        if (!isset($sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno])) {
            $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] = 0;
        }

        // Adicionar o valor do item à soma da congregação e do mês correspondente
        $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] += $linhas["valor"];

        // Atualizar a soma geral
        $totalGeral += $linhas["valor"];
    }
}

$html .= '</table>';

// Exibir a tabela HTML
echo $html;

// Exibir a soma por congregação e mês
echo '<br><br><h2>Soma dos Valores por Congregação e Mês:</h2>';
echo '<table border="1">';
echo '<tr><td><b>Congregação</b></td><td><b>Mês</b></td><td><b>Soma</b></td></tr>';

foreach ($sumByCongregationAndMonth as $congregation => $sumsByMonth) {
    foreach ($sumsByMonth as $mesAno => $soma) {
        echo '<tr>';
        echo '<td>' . $congregation . '</td>';
        echo '<td>' . date("M", strtotime($mesAno . '-01')) . '</td>';
        echo '<td>R$ ' . number_format($soma, 2, ',', '.') . '</td>';
        echo '</tr>';
    }
}

echo '</table>';

// Exibir a soma geral
echo '<br><h2>Soma Geral:</h2>';
echo '<p>R$ ' . number_format($totalGeral, 2, ',', '.') . '</p>';
?>

