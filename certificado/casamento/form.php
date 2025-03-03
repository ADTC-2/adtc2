<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Cadastro de Registro de Casamento</h1>
            </div>
            <div class="card-body">
                <form id="form-casamento">
                    <!-- Número do Registro -->
                    <div class="form-section">
                        <div class="mb-3">
                            <label for="numero" class="form-label"></label>
                            <input type="hidden" class="form-control" id="numero" name="numero" required>
                        </div>
                    </div>

                    <!-- Dados da Noiva -->
                    <div class="form-section">
                        <h2>Dados da Noiva</h2>
                        <div class="mb-3">
                            <label for="nome_noiva" class="form-label">Nome da Noiva</label>
                            <input type="text" class="form-control" id="nome_noiva" name="nome_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf_noiva" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_noiva" name="cpf_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento_noiva" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento_noiva" name="data_nascimento_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade_nascimento_noiva" class="form-label">Cidade de Nascimento</label>
                            <input type="text" class="form-control" id="cidade_nascimento_noiva" name="cidade_nascimento_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_noiva" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_noiva" name="uf_noiva" maxlength="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="filha_de_noiva" class="form-label">Mãe</label>
                            <input type="text" class="form-control" id="mae_de_noiva" name="mae_de_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="filho_de_noiva" class="form-label">Pai</label>
                            <input type="text" class="form-control" id="pai_de_noiva" name="pai_de_noiva" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado_civil_noiva" class="form-label">Estado Civil Pais da Noiva</label>
                            <input type="text" class="form-control" id="estado_civil_noiva" name="estado_civil_noiva" required>
                        </div>
                    </div>

                    <!-- Dados do Noivo -->
                    <div class="form-section">
                        <h2>Dados do Noivo</h2>
                        <div class="mb-3">
                            <label for="nome_noivo" class="form-label">Nome do Noivo</label>
                            <input type="text" class="form-control" id="nome_noivo" name="nome_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf_noivo" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_noivo" name="cpf_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento_noivo" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento_noivo" name="data_nascimento_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade_nascimento_noivo" class="form-label">Cidade de Nascimento</label>
                            <input type="text" class="form-control" id="cidade_nascimento_noivo" name="cidade_nascimento_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_noivo" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_noivo" name="uf_noivo" maxlength="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="filha_de_noivo" class="form-label">Mãe</label>
                            <input type="text" class="form-control" id="mae_de_noivo" name="mae_de_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="filho_de_noivo" class="form-label">Pai</label>
                            <input type="text" class="form-control" id="pai_de_noivo" name="pai_de_noivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado_civil_noivo" class="form-label">Estado Civil dos Pais do Noivo</label>
                            <input type="text" class="form-control" id="estado_civil_noivo" name="estado_civil_noivo" required>
                        </div>
                    </div>

                    <!-- Dados da Cerimônia -->
                    <div class="form-section">
                        <h2>Dados da Cerimônia</h2>
                        <div class="mb-3">
                            <label for="local_celebracao" class="form-label">Local da Celebração</label>
                            <input type="text" class="form-control" id="local_celebracao" name="local_celebracao" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_celebracao" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data_celebracao" name="data_celebracao" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf_celebracao" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_celebracao" name="uf_celebracao" maxlength="2" required>
                        </div>
                        <div class="mb-3">
                            <label for="ministro" class="form-label">Ministro</label>
                            <input type="text" class="form-control" id="ministro" name="ministro" required>
                        </div>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="text-center">
                        <div class="d-inline-block">
                            <button type="button" id="btn-salvar" class="btn btn-success">Salvar Registro</button>
                        </div>
                        <div class="d-inline-block" style="margin-left: 10px;">
                            <a href="generate.php" class="btn btn-primary">Gerar documento</a>
                        </div>
                        <div class="d-inline-block" style="margin-left: 10px;">
                            <button class="btn btn-warning" onclick="goBack()">Voltar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btn-salvar').on('click', function() {
                var formData = $('#form-casamento').serialize();

                $.ajax({
                    url: 'salvar_registro.php', // Mude para o caminho do seu script de salvamento
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Registro salvo com sucesso!');
                        // Aqui você pode fazer outras coisas, como redirecionar ou limpar o formulário
                    },
                    error: function(xhr, status, error) {
                        alert('Ocorreu um erro ao salvar o registro.');
                    }
                });
            });
        });
    </script>
        <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>



