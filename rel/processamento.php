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
$congregacao = isset($_POST['congregacao']) ? htmlspecialchars($_POST['congregacao'], ENT_QUOTES, 'UTF-8') : '';

// Define o nome do arquivo
$arquivo = 'Total_membros_campo.xls';

// Inicializa o conteúdo HTML
$html = '';
$html .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
$html .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;">';
$html .= '<tr>';
$html .= '<td colspan="7" style="background-color: #f2f2f2; text-align: center; font-weight: bold; font-size: 14px;">Total Membros - ' . ($congregacao ? $congregacao : 'Todas as Congregações') . '</td>';
$html .= '</tr>';

$html .= '<tr style="background-color: #d9d9d9; font-weight: bold; text-align: center;">';
$html .= '<td style="padding: 8px;">Matricula</td>';
$html .= '<td style="padding: 8px;">Nome</td>';
$html .= '<td style="padding: 8px;">Funcao</td>';
$html .= '<td style="padding: 8px;">Congregacao</td>';
$html .= '<td style="padding: 8px;">Dt_Nascimento</td>';
$html .= '<td style="padding: 8px;">Status</td>';
$html .= '<td style="padding: 8px;">Criado em</td>';
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

if ($stmt->rowCount() > 0) {
    foreach ($stmt->fetchAll() as $linhas) {
        $dataNascimento = new DateTime($linhas["dataNascimento"]);
        $dataNascimentoFormatada = $dataNascimento->format('d/m/Y'); // Formata a data para dd/mm/aaaa

        $html .= '<tr>';
        $html .= '<td style="text-align: center; padding: 8px;">' . htmlspecialchars($linhas["matricula"], ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td style="padding: 8px;">' . htmlspecialchars($linhas["nome"], ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td style="padding: 8px;">' . htmlspecialchars($linhas["funcao"], ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td style="padding: 8px;">' . htmlspecialchars($linhas["congregacao"], ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td style="text-align: center; padding: 8px;">' . htmlspecialchars($dataNascimentoFormatada, ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td style="padding: 8px;">' . htmlspecialchars($linhas["status"], ENT_QUOTES, 'UTF-8') . '</td>';
        $data = date('d/m/Y H:i:s');
        $html .= '<td style="text-align: center; padding: 8px;">' . $data . '</td>';
        $html .= '</tr>';
    }
}

// Configurações para forçar o download
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$arquivo\"");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
header("Pragma: public");

// Envia o conteúdo do arquivo
echo $html;
exit;
?>


