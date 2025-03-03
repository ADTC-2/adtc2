<?php
session_start();
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    //Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    //Redireciona para a página de autenticação
    header('location:login.php');
}

require '../db/config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM agendamento WHERE id ='$id' LIMIT 1";
$sql = $pdo->query($sql);
if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $linhas) {
    }
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// Extend TCPDF with your own class
class MYPDF extends TCPDF {

    // Page header
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(0, 10, 'Termo de Responsabilidade | Agendamento Buffet', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // Line break
        $this->Ln(10);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Termo de Responsabilidade | Agendamento Buffet');
$pdf->SetSubject('Termo de Responsabilidade | Agendamento Buffet');
$pdf->SetKeywords('TCPDF, PDF, termo, responsabilidade, agendamento, buffet');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// writeHTML content
$html = '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Termo de Responsabilidade | Agendamento Buffet</title>
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <div class="container">
        <!-- Your HTML content here -->
        <h2>Termo de Responsabilidade | Agendamento Buffet</h2>
        <p><strong>Solicitante</strong>: ' . $linhas['solicitante'] . '</p>
        <p><strong>Tipo de Evento</strong>: ' . $linhas['tipo_evento'] . '</p>
        <p><strong>Horário</strong>: ' . $linhas['horario'] . '</p>
        <p><strong>Data do Evento</strong>: ' . date("d/m/Y", strtotime($linhas['data_evento'])) . '</p>
        <p><strong>Telefone</strong>: ' . $linhas['telefone'] . '</p>
        <p><strong>Status</strong>: ' . $linhas['situacao'] . '</p>
        <p><strong>Agendado em</strong>: ' . date("d/m/Y", strtotime($linhas['dataAgendamento'])) . '</p>
        <p><strong>Declaro</strong> que, mediante este instrumento de aceitação, sou o(a) responsável pelo uso e conservação do(s) espaço(s) utilizado(s) e todo o seu conteúdo e assumo o compromisso de devolvê-lo(s) em perfeito estado, findo o período utilizado. Em caso de extravio e/ou dano, total ou parcial, do patrimônio utilizado, fico obrigado(a) a ressarcir a IGREJA ASSEMBLEIA DE DEUS TEMPLO CENTRAL II - MARANGUAPE - CE dos prejuízos decorrentes. Fico ciente ainda: transporte, recebimento e/ou remoção de mobiliário adicional, bem como o acompanhamento a empresas terceirizadas, contratadas pelo(a) organizador(a) do Evento, são atividades do solicitante, mediante ciência e autorização prévia da ADTCII.</p>
        <p><strong>Taxa de utilização</strong>: R$ 100,00 <br>
        O pagamento deverá ser realizado no dia do evento ao irmão Nacelio - <strong>(85)98792-7366</strong></p>
        <p><strong>Eribaldo Medeiros Coelho</strong><br>Pastor-Presidente</p>
        <p><strong>Secretaria Geral ADTC2</strong><br>Secretario</p>
    </div>
</body>
</html>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('termo_de_responsabilidade.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
