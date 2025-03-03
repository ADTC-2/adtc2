<?php
session_start();
require '../db/config.php';

// Verifique se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
    $data_inicio = $_GET['data_inicio'];
    $data_fim = $_GET['data_fim'];

    // Use declaração preparada para evitar SQL injection
    $sql = $pdo->prepare("SELECT * FROM eventos WHERE dt_evento BETWEEN :data_inicio AND :data_fim");
    $sql->bindParam(':data_inicio', $data_inicio, PDO::PARAM_STR);
    $sql->bindParam(':data_fim', $data_fim, PDO::PARAM_STR);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        // Criação do conteúdo HTML
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Eventos</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <style>
                body {
                    padding: 20px;
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                }
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                    background: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                .button-group {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }
                .button-group .btn {
                    margin: 0;
                }
                .btn-secondary {
                    border: none; /* Remove a borda do botão Voltar */
                    box-shadow: none; /* Remove a sombra do botão Voltar */
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, th, td {
                    border: 1px solid #dee2e6;
                }
                th, td {
                    padding: 12px;
                    text-align: left;
                }
                th {
                    background-color: #e9ecef;
                    cursor: pointer;
                }
                th.sortable::after {
                    content: "\f0dc"; /* Default sort icon (Font Awesome) */
                    font-family: "Font Awesome 6 Free";
                    font-weight: 900;
                    padding-left: 10px;
                }
                th.sortable.sorted-asc::after {
                    content: "\f0de"; /* Ascending sort icon */
                }
                th.sortable.sorted-desc::after {
                    content: "\f0dd"; /* Descending sort icon */
                }
                .status-tag {
                    display: inline-block;
                    padding: 5px 10px;
                    border-radius: 4px;
                    color: #fff;
                    font-weight: bold;
                }
                .status-agendado {
                    background-color: #28a745; /* Green */
                }
                .status-realizado {
                    background-color: #6c757d; /* Brown */
                }
                .no-events {
                    text-align: center;
                    font-size: 1.2rem;
                }
                @media print {
                    body {
                        background: none;
                        padding: 0;
                    }
                    .container {
                        box-shadow: none;
                        border-radius: 0;
                        width: 100%;
                        max-width: none;
                        margin: 0;
                    }
                    table {
                        width: 100%;
                        page-break-inside: auto;
                    }
                    th, td {
                        padding: 8px;
                    }
                    .status-tag {
                        font-size: 0.9rem;
                    }
                    .print-button, .back-button {
                        display: none; /* Oculta os botões durante a impressão */
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="button-group">
                    <a href="javascript:history.back()" class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Voltar</a>
                    <button class="btn btn-primary print-button" onclick="window.print()"><i class="fas fa-print"></i></button>
                </div>
                <h1 class="text-center mb-4">Agenda de Eventos</h1>
                <table class="table table-striped" id="eventTable">
                    <thead>
                        <tr>
                            <th class="sortable" data-column="evento">Evento</th>
                            <th class="sortable" data-column="informacoes">Informações</th>
                            <th class="sortable" data-column="congregacao">Congregação</th>
                            <th class="sortable" data-column="dt_evento">Data</th>
                            <th class="sortable" data-column="situacao">Status</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($sql->fetchAll() as $linhas) {
            $evento = htmlspecialchars($linhas["evento"]);
            $informacoes = isset($linhas["informacoes"]) ? htmlspecialchars($linhas["informacoes"]) : 'Não disponível';
            $congregacao = htmlspecialchars($linhas["congregacao"]);
            $dt_evento = date("d/m/Y", strtotime($linhas["dt_evento"]));
            $situacao = htmlspecialchars($linhas["situacao"]);

            // Determine a classe de status e o valor com base na data do evento
            $currentDate = date("Y-m-d");
            $eventDate = date("Y-m-d", strtotime($linhas["dt_evento"]));
            $status_class = ($eventDate < $currentDate) ? 'status-realizado' : 'status-agendado';
            $status_text = ($eventDate < $currentDate) ? 'Realizado' : $situacao;

            $html .= '<tr>';
            $html .= '<td>' . $evento . '</td>';
            $html .= '<td>' . $informacoes . '</td>';
            $html .= '<td>' . $congregacao . '</td>';
            $html .= '<td>' . $dt_evento . '</td>';
            $html .= '<td><span class="status-tag ' . $status_class . '">' . $status_text . '</span></td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const table = document.getElementById("eventTable");
                    const headers = table.querySelectorAll("th.sortable");

                    headers.forEach(header => {
                        header.addEventListener("click", function() {
                            const column = this.getAttribute("data-column");
                            const isAscending = this.classList.contains("sorted-asc");
                            const rows = Array.from(table.querySelector("tbody").querySelectorAll("tr"));

                            rows.sort((rowA, rowB) => {
                                const cellA = rowA.querySelector(`td:nth-child(${[...header.parentNode.children].indexOf(this) + 1})`).textContent.trim();
                                const cellB = rowB.querySelector(`td:nth-child(${[...header.parentNode.children].indexOf(this) + 1})`).textContent.trim();
                                
                                if (cellA < cellB) return isAscending ? 1 : -1;
                                if (cellA > cellB) return isAscending ? -1 : 1;
                                return 0;
                            });

                            rows.forEach(row => table.querySelector("tbody").appendChild(row));

                            headers.forEach(h => h.classList.remove("sorted-asc", "sorted-desc"));
                            this.classList.add(isAscending ? "sorted-desc" : "sorted-asc");
                        });
                    });
                });
            </script>
        </body>
        </html>';

        echo $html;
    } else {
        echo '<div class="container"><p class="no-events">Nenhum evento encontrado no período especificado.</p></div>';
    }
} else {
    echo '<div class="container"><p class="no-events">Parâmetros de data não fornecidos.</p></div>';
}
?>














