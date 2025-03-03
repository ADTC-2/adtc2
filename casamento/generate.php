<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}

require_once '../db/config.php';

$id = $_GET['id'] ?? '';

if (empty($id) || !is_numeric($id)) {
    echo "ID inválido.";
    exit();
}

$sql = "SELECT * FROM casamento WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$registro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$registro) {
    echo "Registro de casamento não encontrado.";
    exit();
}

$nome_noiva = $registro['nome_noiva'];
$cpf_noiva = $registro['cpf_noiva'];
$data_nascimento_noiva = $registro['data_nascimento_noiva'];
$cidade_nascimento_noiva = $registro['cidade_nascimento_noiva'];
$uf_noiva = $registro['uf_noiva'];
$mae_de_noiva = $registro['mae_de_noiva'];
$pai_de_noiva = $registro['pai_de_noiva'];
$estado_civil_pais_noiva = $registro['estado_civil_pais_noiva'];

$nome_noivo = $registro['nome_noivo'];
$cpf_noivo = $registro['cpf_noivo'];
$data_nascimento_noivo = $registro['data_nascimento_noivo'];
$cidade_nascimento_noivo = $registro['cidade_nascimento_noivo'];
$uf_noivo = $registro['uf_noivo'];
$maenoivo = $registro['maenoivo'];
$painoivo = $registro['painoivo'];
$estado_civil_pais_noivo = $registro['estado_civil_pais_noivo'];

$local_celebracao = $registro['local_celebracao'];
$data_celebracao = $registro['data_celebracao'];
$uf_celebracao = $registro['uf_celebracao'];
$ministro = $registro['ministro'];

$data_criacao = $registro['data_criacao'];

$data_criacao_formatada = (new DateTime($data_criacao))->format('d/m/Y');
$data_nascimento_noiva_formatada = (new DateTime($data_nascimento_noiva))->format('d/m/Y');
$data_nascimento_noivo_formatada = (new DateTime($data_nascimento_noivo))->format('d/m/Y');
$data_celebracao_formatada = (new DateTime($data_celebracao))->format('d/m/Y');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Casamento Civil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/generate.css">
</head>
<body>
    <div class="container mt-3">
        <div class="card border border-light">
            <div class="header text-center">                
                <h1>Registro de Casamento Religioso</h1>
            </div>
            <div class="logo">
               <img id="logo" src="../imagens/img_carteira/ADTC2 VERMELHO.png" alt="Logo">
            </div>
            
            <p class="text-center"><strong>Número:</strong> <?php echo htmlspecialchars($id); ?></p>
            <p class="text-center"><strong>Data de Criação:</strong> <?php echo htmlspecialchars($data_criacao_formatada); ?></p>

            <h4>Dados da Noiva</h4>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome_noiva); ?></p>
            <p><strong>CPF:</strong> <?php echo htmlspecialchars($cpf_noiva); ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($data_nascimento_noiva_formatada); ?></p>
            <p><strong>Naturalidade:</strong> <?php echo htmlspecialchars($cidade_nascimento_noiva); ?> - <strong>UF:</strong> <?php echo htmlspecialchars($uf_noiva); ?></p>
            <p><strong>Filha de:</strong> <?php echo htmlspecialchars($mae_de_noiva); ?> <strong> e </strong><?php echo htmlspecialchars($pai_de_noiva); ?></p>
           

            <h4>Dados do Noivo</h4>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome_noivo); ?></p>
            <p><strong>CPF:</strong> <?php echo htmlspecialchars($cpf_noivo); ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($data_nascimento_noivo_formatada); ?></p>
            <p><strong>Naturalidade:</strong> <?php echo htmlspecialchars($cidade_nascimento_noivo); ?> - <strong>UF:</strong> <?php echo htmlspecialchars($uf_noivo); ?></p>
            <p><strong>Filho de:</strong> <?php echo htmlspecialchars($maenoivo); ?> <strong> e </strong> <?php echo htmlspecialchars($painoivo); ?></p>
           

            <h4>Dados da Cerimônia</h4>
            <p><strong>Local da Celebração:</strong> <?php echo htmlspecialchars($local_celebracao); ?></p>
            <p><strong>Data:</strong> <?php echo htmlspecialchars($data_celebracao_formatada); ?> - <strong>UF:</strong> <?php echo htmlspecialchars($uf_celebracao); ?></p>
            <p><strong>Ministro:</strong> <?php echo htmlspecialchars($ministro); ?></p>

            <div class="texto">
                <p class="artigo">
                    Os noivos apresentaram certidão de casamento civil já realizado, pelo que, a seu pedido, celebrei-lhes a cerimônia religiosa
                    do enlace matrimonial segundo os cânones da igreja ASSEMBLEIA DE DEUS TEMPLO CENTRAL II - Maranguape -CE.
                </p>
            </div>

            <div id="assinaturas">
                <div class="row mt-3">
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Noivo</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Noiva</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 1 (Noivo)</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 1  (Noiva)</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 2 (Noivo)</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 2 (Noiva)</p>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <div class="signature-line"></div>
                    <p class="signature-label">Ministro</p>
                </div>
            </div>
            
            <footer class="endereco">
                <p>Igreja Evangelica Assembleia de Deus - Templo Central II</p>
                <p>Maranguape CE</p>
                <p>CNPJ 44.588.989/0001-71</p>
                <p>Endereço: Rua Coronel Antônio Botelho, 252 – Parque Santa Fé</p>
                <p>Maranguape – CE, 61940-380</p>
                <p>Pastor Presidente - Eribaldo Medeiros Coelho</p>
            </footer>

        </div>
    </div>
</body>
</html>











