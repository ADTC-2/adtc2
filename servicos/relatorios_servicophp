<?php
session_start();
require '../../db/config.php';

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit; // Importante: saia do script após o redirecionamento
}

require '../../vendor/autoload.php'; // Certifique-se de que o caminho para o arquivo do DomPDF esteja correto

use Dompdf\Dompdf;

// Crie um novo objeto Dompdf com as opções
$pdf = new Dompdf();

// Defina o título do documento PDF
$pdf->getOptions()->set('title', 'Agenda de Eventos');

// Defina o estilo da fonte
$pdf->getOptions()->set('defaultFont', 'helvetica');

$html = '';

if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
    $data_inicio = $_GET['data_inicio'];
    $data_fim = $_GET['data_fim'];

    // Use declaração preparada para evitar SQL injection
    $sql = $pdo->prepare("SELECT * FROM eventos WHERE dataCaptura BETWEEN :data_inicio AND :data_fim");
    $sql->bindParam(':data_inicio', $data_inicio, PDO::PARAM_STR);
    $sql->bindParam(':data_fim', $data_fim, PDO::PARAM_STR);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="6"><b>Agenda de Eventos</b></td>';
        $html .= '</tr>';
        $html .= '<style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>';
        $html .= '<tr>';
        $html .= '<td><b>Evento</b></td>';
        $html .= '<td><b>Informações</b></td>';
        $html .= '<td><b>Congregação</b></td>';
        $html .= '<td><b>Data</b></td>';
        $html .= '<td><b>Status</b></td>';
        $html .= '</tr>';

        foreach ($sql->fetchAll() as $linhas) {
            $html .= '<tr>';
            $html .= '<td>' . $linhas["evento"] . '</td>';
            $html .= '<td>' . $linhas["congregacao"] . '</td>';
            $html .= '<td>' . date("d/m/Y", strtotime($linhas["dt_evento"])) . '</td>';
            $html .= '<td>' . $linhas["situacao"] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        // Carregue o HTML no Dompdf
        $pdf->loadHtml($html);

        // Renderize o PDF
        $pdf->render();

        // Defina o cabeçalho para forçar o download do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Eventos.pdf"');

        // Saída do PDF como um arquivo para download
        echo $pdf->output();
        exit;
    } else {
        $html .= '<p>Nenhum evento encontrado no período especificado.</p>';
    }
}

echo $html;
?>
