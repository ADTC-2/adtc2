<?php
session_start();

if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Finaliza o script para garantir que a página não seja renderizada
}

require_once "../db/config.php";

// Parâmetros da paginação
$porPagina = isset($_POST['length']) ? intval($_POST['length']) : 5; // Quantidade de resultados por página
$paginaAtual = isset($_POST['start']) ? ($_POST['start'] / $porPagina) + 1 : 1; // Página atual, padrão é 1

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM documentos")->fetchColumn();

// Consulta com LIMIT para a paginação
$sql = "SELECT * FROM documentos LIMIT $indiceInicio, $porPagina";
$query = $pdo->query($sql);

// Prepara os dados para retorno
$dados = [];
if ($query->rowCount() > 0) {
    while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
        $dados[] = $linha;
    }
}

// Retorna os dados no formato JSON
echo json_encode([
    "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 1, // Número de solicitações enviadas pelo DataTables
    "recordsTotal" => $totalRegistros, // Total de registros no banco de dados
    "recordsFiltered" => $totalRegistros, // Total de registros após a filtragem (no nosso caso, não há filtragem)
    "data" => $dados // Dados a serem exibidos na tabela
]);
?>
















