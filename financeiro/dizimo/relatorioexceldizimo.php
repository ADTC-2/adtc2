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

$arquivo = 'Dizimos.xls';

// Configurações de cabeçalho para forçar o download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");

$html = '';
$html .= '<!DOCTYPE html>';
$html .= '<html lang="pt-br">';
$html .= '<head>';
$html .= '<meta charset="UTF-8">';
$html .= '<title>Relatório de Dízimos</title>';
$html .= '</head>';
$html .= '<body>';


// Inicializa uma variável para rastrear a soma geral de todos os valores
$totalGeral = 0;

// Inicializa um array para armazenar a soma dos valores por congregação e mês
$sumByCongregationAndMonth = [];
// Inicializa um array para armazenar a soma dos valores por dia
$sumByDay = [];

// Selecionar todos os itens da tabela
$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sql = "SELECT * FROM dizimo WHERE dataCaptura BETWEEN '$data_inicio' AND '$data_fim'";
} else {
    $sql = "SELECT * FROM dizimo WHERE congregacao='$congregacao' AND dataCaptura BETWEEN '$data_inicio' AND '$data_fim'";
}

$resultado = $pdo->query($sql);

if ($resultado->rowCount() > 0) {
    foreach ($resultado->fetchAll() as $linha) {

        // Obter o mês e o ano da dataCaptura
        $mesAno = date("Y-m", strtotime($linha["dataCaptura"]));
        // Obter o dia da dataCaptura
        $dia = date("Y-m-d", strtotime($linha["dataCaptura"]));

        // Inicializar a soma do mês para a congregação se ainda não estiver definida
        if (!isset($sumByCongregationAndMonth[$linha["congregacao"]][$mesAno])) {
            $sumByCongregationAndMonth[$linha["congregacao"]][$mesAno] = 0;
        }

        // Adicionar o valor do item à soma da congregação e do mês correspondente
        $sumByCongregationAndMonth[$linha["congregacao"]][$mesAno] += $linha["valor"];

        // Inicializar a soma do dia se ainda não estiver definida
        if (!isset($sumByDay[$dia])) {
            $sumByDay[$dia] = 0;
        }

        // Adicionar o valor do item à soma do dia correspondente
        $sumByDay[$dia] += $linha["valor"];

        // Atualizar a soma geral
        $totalGeral += $linha['valor'];
    }
}

$html .= '</table>';

// Exibir a tabela HTML
echo $html;

// Exibir a soma por congregação e mês
echo '<br><br><h2>Total Congregação e Mês:</h2>';
echo '<table border="1">';
echo '<tr><td><b>Congregação</b></td><td><b>Mês</b></td><td><b>Soma</b></td></tr>';

foreach ($sumByCongregationAndMonth as $congregacao => $somasPorMes) {
    foreach ($somasPorMes as $mesAno => $soma) {
        echo '<tr>';
        echo '<td>' . $congregacao . '</td>';
        echo '<td>' . date("M", strtotime($mesAno . '-01')) . '</td>';
        echo '<td>R$ ' . number_format($soma, 2, ',', '.') . '</td>'; // Formatando para Reais
        echo '</tr>';
    }
}

echo '</table>';

// Exibir a soma por dia
echo '<br><br><h2>Soma dos Valores por Dia:</h2>';
echo '<table border="1">';
echo '<tr><td><b>Dia</b></td><td><b>Soma</b></td></tr>';

foreach ($sumByDay as $dia => $soma) {
    echo '<tr>';
    echo '<td>' . date("d/m/Y", strtotime($dia)) . '</td>';
    echo '<td>R$ ' . number_format($soma, 2, ',', '.') . '</td>'; // Formatando para Reais
    echo '</tr>';
}

echo '</table>';

// Exibir a soma geral
echo '<br><h2>Soma Geral:</h2>';
echo '<p>R$ ' . number_format($totalGeral, 2, ',', '.') . '</p>'; // Formatando para Reais
?>



