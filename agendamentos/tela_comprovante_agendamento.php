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

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/agendamento.css">
    <title>Comprovante</title>
</head>

<body>
    <style>
        @media print {
            nav {
                display: none;
            }
        }

        @media screen and (max-width: 768px) {
            .centered {
                text-align: center;
            }
        }
    </style>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="float-left">
                <a class="btn btn-primary" href="javascript:window.print();" style="margin-right: 10px;">Imprimir</a> 
              
                <a class="btn btn-secondary" href="tela_lista_agendamento.php">Voltar</a>
            </div>
            
        </div>
    </nav>
    <div class="container">
        <div class="texto2">
            <img id="checkIn1" src="../imagens/diversas_imagens/logAdtcII.png" alt="">
        </div>
        <hr>
        <h2><span style="margin-left: 10px;">Termo de Responsabilidade | Agendamento Buffet</span></h2>
        <div class="texto4">
            <p><strong>Solicitante</strong>: <?php echo $linhas['solicitante']; ?></p><br>
            <p><strong>Tipo de Evento</strong>: <?php echo $linhas['tipo_evento']; ?></p><br>
            <p><strong>Horário</strong>: <?php echo $linhas['horario']; ?></p><br>
            <p><strong>Data do Evento</strong>: <?php echo date("d/m/Y", strtotime($linhas['data_evento'])); ?></p><br>
            <p><strong>Telefone</strong>: <?php echo $linhas['telefone']; ?></p><br>
            <p><strong>Status</strong>: <?php echo $linhas['situacao']; ?></p><br>
            <p><strong>Agendado em</strong>: <?php echo date("d/m/Y", strtotime($linhas['dataAgendamento'])); ?></p><br>
        </div>
        <div class="texto1">
            <p><strong>Declaro</strong> que, mediante este instrumento de aceitação, sou o(a) responsável pelo uso e conservação do(s) espaço(s) utilizado(s) e todo o seu conteúdo e assumo o compromisso de devolvê-lo(s) em perfeito estado, findo o período utilizado. Em caso de extravio e/ou dano, total ou parcial, do patrimônio utilizado, fico obrigado(a) a ressarcir a IGREJA ASSEMBLEIA DE DEUS TEMPLO CENTRAL II - MARANGUAPE - CE dos prejuízos decorrentes. Fico ciente ainda: transporte, recebimento e/ou remoção de mobiliário adicional, bem como o acompanhamento a empresas terceirizadas, contratadas pelo(a) organizador(a) do Evento, são atividades do solicitante, mediante ciência e autorização prévia da ADTCII.</p>
        </div>
        <div class="texto2">
            <img id="checkIn" src="../imagens/diversas_imagens/Agendamento_new.png" alt="">
        </div>
        <div class="texto3">
            <p><strong>Taxa de utilização</strong>: R$ 100,00 <br>
                O pagamento deverá ser realizado no dia do evento ao irmão Nacelio - <strong>(85)98792-7366</strong></p>
        </div>
        <div class="texto5">
            <img id="img_ass" src="../imagens/img_carteira/assinatura.png" alt="" srcset="">
            <p class="center-text"><strong>Eribaldo Medeiros Coelho</strong><br>            
            Pastor-Presidente</p>
        </div>
        <div class="texto6">
            <p class="center-text"><strong>Secretaria Geral ADTC2</strong><br>
            Secretario</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>

