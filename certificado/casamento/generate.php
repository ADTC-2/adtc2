<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro de Registro de Casamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/generate.css">
</head>
<body>
    <div class="container mt-3">
        <div class="card">
            <h1 class="text-center">Registro de Casamento</h1>
            <p class="text-center">Número: <?php echo htmlspecialchars($numero); ?></p>

            <h4>Dados da Noiva</h4>
            <p>Nome: <?php echo htmlspecialchars($nome_noiva); ?></p>
            <p>Data de Nascimento: <?php echo htmlspecialchars($data_nascimento_noiva); ?></p>
            <p>Cidade de Nascimento: <?php echo htmlspecialchars($cidade_nascimento_noiva); ?> - UF: <?php echo htmlspecialchars($uf_noiva); ?></p>
            <p>Filha de: <?php echo htmlspecialchars($mae_de_noiva); ?> e <?php echo htmlspecialchars($pai_de_noiva); ?></p>
            <p>Estado Civil: <?php echo htmlspecialchars($estado_civil_noiva); ?></p>

            <h4>Dados do Noivo</h4>
            <p>Nome: <?php echo htmlspecialchars($nome_noivo); ?></p>
            <p>Data de Nascimento: <?php echo htmlspecialchars($data_nascimento_noivo); ?></p>
            <p>Cidade de Nascimento: <?php echo htmlspecialchars($cidade_nascimento_noivo); ?> - UF: <?php echo htmlspecialchars($uf_noivo); ?></p>
            <p>Filho de: <?php echo htmlspecialchars($mae_de_noivo); ?> e <?php echo htmlspecialchars($pai_de_noivo); ?></p>
            <p>Estado Civil: <?php echo htmlspecialchars($estado_civil_noivo); ?></p>

            <h4>Dados da Cerimônia</h4>
            <p>Local da Celebração: <?php echo htmlspecialchars($local_celebracao); ?></p>
            <p>Data: <?php echo htmlspecialchars($data_celebracao); ?> - UF: <?php echo htmlspecialchars($uf_celebracao); ?></p>
            <p>Ministro: <?php echo htmlspecialchars($ministro); ?></p>

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
                        <p class="signature-label">Testemunha 1 (Noiva)</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 2 (Noiva)</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 1 (Noivo)</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="signature-line"></div>
                        <p class="signature-label">Testemunha 2 (Noivo)</p>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <div class="signature-line"></div>
                    <p class="signature-label">Ministro</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>






