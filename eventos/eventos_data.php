<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:../login.php');
    exit();
}

require '../db/config.php';

header('Content-Type: application/json');

try {
    // Consulta SQL para selecionar todos os campos necessários
    $stmt = $pdo->query("SELECT id, evento, anotacoes, congregacao, dt_evento, situacao FROM eventos WHERE situacao = 'agendado'");
    $events = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Formatando a data no formato ISO 8601
        $start = (new DateTime($row['dt_evento']))->format(DateTime::ATOM);
        $end = null; // Se não houver um campo de data de término, mantenha como null

        $events[] = [
            'id' => $row['id'],
            'title' => $row['evento'],
            'description' => $row['anotacoes'],
            'congregacao' => $row['congregacao'],
            'start' => $start,
            'end' => $end,
        ];
    }

    echo json_encode($events);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}






