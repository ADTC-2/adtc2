<?php
session_start();

if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:login.php');
    exit();
}

require_once "../db/config.php";

$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'mes_asc';
$mesSelecionado = isset($_GET['mes']) ? $_GET['mes'] : null;

switch ($ordenar) {
    case 'mes_asc':
        $sql = "SELECT * FROM eventos WHERE MONTH(dt_evento) = :mesSelecionado ORDER BY DAY(dt_evento) ASC";
        break;
    case 'mes_desc':
        $sql = "SELECT * FROM eventos WHERE MONTH(dt_evento) = :mesSelecionado ORDER BY DAY(dt_evento) DESC";
        break;
    default:
        $sql = "SELECT * FROM eventos";
        break;
}

$query = $pdo->prepare($sql);
if ($mesSelecionado) {
    $query->bindParam(':mesSelecionado', $mesSelecionado, PDO::PARAM_INT);
}
$query->execute();
$eventos = $query->fetchAll(PDO::FETCH_ASSOC);

// Ajuste da data para o formato correto
foreach ($eventos as &$evento) {
    $evento['dt_evento'] = date('Y-m-d', strtotime($evento['dt_evento']));
}

echo json_encode(['data' => $eventos]);
?>




