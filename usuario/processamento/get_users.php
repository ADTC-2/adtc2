<?php
session_start();

require_once "../../db/config.php";

if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Se não houver sessão, redireciona para a página de login
    header('location:login.php');
    exit(); // Finaliza o script para garantir que a página não seja renderizada
}
if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}
// Parâmetros da paginação (supondo que você esteja usando DataTables com servidor-side processing)
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1; // Número de solicitações enviadas pelo DataTables
$porPagina = isset($_POST['length']) ? intval($_POST['length']) : 5; // Quantidade de resultados por página
$paginaAtual = isset($_POST['start']) ? ($_POST['start'] / $porPagina) + 1 : 1; // Página atual, padrão é 1

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();

// Consulta com LIMIT para a paginação
$sql = "SELECT * FROM usuarios LIMIT $indiceInicio, $porPagina";
$query = $pdo->query($sql);

// Prepara os dados para retorno no formato necessário para DataTables
$dados = [];
if ($query->rowCount() > 0) {
    while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
        $dados[] = $linha;
    }
}

// Retorna os dados no formato JSON esperado pelo DataTables
echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalRegistros,
    "recordsFiltered" => $totalRegistros,
    "data" => $dados
]);
?>




