<?php
session_start();
require '../db/config.php';

// Verifica se a sessão está ativa
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit;
}

// Recebe a variável do formulário
$congregacao = isset($_POST['congregacao']) ? htmlspecialchars($_POST['congregacao']) : '';

// Define o nome do arquivo
$arquivo = 'Total_membros_campo.xls';

// Inicializa o conteúdo HTML
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="7">Total Membros - ' . ($congregacao ? $congregacao : 'Todas as Congregações') . '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>Matricula</b></td>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td><b>Funcao</b></td>';
$html .= '<td><b>Congregacao</b></td>';
$html .= '<td><b>Dt_Nascimento</b></td>';
$html .= '<td><b>Status</b></td>';
$html .= '<td><b>Criado em</b></td>';
$html .= '</tr>';

// Modifica a consulta SQL com base na variável 'congregacao'
$sql = "SELECT * FROM filiado";
if ($congregacao) {
    $sql .= " WHERE congregacao = :congregacao";
}

// Prepara e executa a consulta
$stmt = $pdo->prepare($sql);
if ($congregacao) {
    $stmt->bindParam(':congregacao', $congregacao);
}
$stmt->execute();
$dataNascimento = new DateTime($linhas["dataNascimento"]);
$dataNascimentoFormatada = $dataNascimento->format('d/m/Y');

if ($stmt->rowCount() > 0) {
    
    foreach ($stmt->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($linhas["matricula"]) . '</td>';
        $html .= '<td>' . htmlspecialchars($linhas["nome"]) . '</td>';
        $html .= '<td>' . htmlspecialchars($linhas["funcao"]) . '</td>';
        $html .= '<td>' . htmlspecialchars($linhas["congregacao"]) . '</td>';
        $html .= '<td>' . htmlspecialchars($dataNascimentoFormatada) . '</td>';
        $html .= '<td>' . htmlspecialchars($linhas["status"]) . '</td>';
        $data = date('d/m/Y H:i:s');
        $html .= '<td>' . $data . '</td>';
        $html .= '</tr>';
    }
}

// Configurações para forçar o download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$arquivo\"");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
header("Pragma: public");

// Envia o conteúdo do arquivo
echo $html;
exit;
?>
