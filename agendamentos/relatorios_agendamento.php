<?php
session_start();
require '../db/config.php';
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Destrói
    session_destroy();
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location: login.php');
}

$arquivo = 'Agendamentos.xls';

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
$html .= '<td colspan="8">Agendamentos</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>ID</b></td>';
$html .= '<td><b>Solicitante</b></td>';
$html .= '<td><b>Tipo Evento</b></td>';
$html .= '<td><b>Horário</b></td>';
$html .= '<td><b>Data Evento</b></td>';
$html .= '<td><b>Telefone</b></td>';
$html .= '<td><b>Situação</b></td>';
$html .= '<td><b>Data de Agendamento</b></td>';
$html .= '</tr>';

// Selecionar todos os itens da tabela
require_once '../db/config.php';

$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));

$sql = "SELECT * FROM agendamento WHERE data_evento BETWEEN '$data_inicio' AND '$data_fim'";
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . $linhas["id"] . '</td>';
        $html .= '<td>' . $linhas["solicitante"] . '</td>';
        $html .= '<td>' . $linhas["tipo_evento"] . '</td>';
        $html .= '<td>' . $linhas["horario"] . '</td>';
        $html .= '<td>' . date("d/m/Y",strtotime($linhas["data_evento"])) . '</td>';
        $html .= '<td>' . $linhas["telefone"] . '</td>';
        $html .= '<td>' . $linhas["situacao"] . '</td>';
        $html .= '<td>' . date("d/m/Y",strtotime($linhas["dataAgendamento"])) . '</td>';
        $html .= '</tr>';        
    }
}

echo $html;
?>
