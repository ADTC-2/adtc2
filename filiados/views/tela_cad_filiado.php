<?php
session_start();
include 'verifica_acesso.php';
if (!isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {  
  // Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  
  // Redireciona para a página de autenticação
  header('location:login.php'); 
}
?>
<?php   
require '../../db/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Cadastrar Filiado</title>
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 30px;
    }

    h1 {
        color: #007bff;
    }

    hr {
        border: 1px solid #007bff;
    }

    label {
        font-weight: 600;
        color: #495057;
    }

    .form-control {
        border-radius: 0.25rem;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-select {
        border-radius: 0.25rem;
    }

    .btn-block {
        width: 100%;
    }

    .text-center {
        text-align: center;
    }

    .no-underline {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cadastrar Novo Filiado</h1>
        <hr>
        <a href="javascript:history.back()" class="btn btn-link no-underline">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
        <a href="../views/tela_controle_filiado.php" class="btn btn-link no-underline">
            <i class="fas fa-list"></i> Listar filiados
        </a>

        <form id="frmRegistro" name="frmRegistro" action="../../procedimentos/cadastrar_filiado.php" method="POST"
            enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" onkeyup="maiuscula(this)">
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-8">
                    <label for="nome_carteira">Nome Carteira</label>
                    <input type="text" class="form-control" name="nome_carteira" onkeyup="maiuscula(this)">
                </div>
                <div class="form-group col-md-4">
                    <label for="funcao">Função</label>
                    <select class="form-select" id="funcao" name="funcao">
                        <option>Selecione</option>
                        <option>Novo Convertido</option>
                        <option>Membro</option>
                        <option>Congregado</option>
                        <option>Auxiliar</option>
                        <option>Diácono</option>
                        <option>Presbítero</option>
                        <option>Evangelista</option>
                        <option>Missionário</option>
                        <option>Pastor-Presidente</option>
                        <option>Co-Pastor</option>
                        <option>Pastor</option>
                    </select>
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-4">
                    <label for="congregacao">Congregação</label>
                    <select class="form-select" id="congregacao" name="congregacao">
                        <option>Selecione</option>
                        <option>SEDE</option>
                        <option>ALEGRIA</option>
                        <option>JUBAIA</option>
                        <option>LAGES</option>
                        <option>NOVO MARANGUAPE 1</option>
                        <option>NOVO MARANGUAPE 2</option>
                        <option>NOVO MARANGUAPE 3</option>
                        <option>NOVO MARANGUAPE 4</option>
                        <option>OUTRA BANDA</option>
                        <option>PARQUE SÃO JOÃO</option>
                        <option>NOVO PARQUE IRACEMA</option>
                        <option>NOVO PARQUE IRACEMA 2</option>
                        <option>SITIO SÃO LUIZ</option>
                        <option>TABATINGA</option>
                        <option>UMARIZEIRAS</option>
                        <option>VITÓRIA</option>
                        <option>VIÇOSA</option>
                        <option>PAPARA</option>
                        <option>PLANALTO</option>
                        <option>SERRA JUBAIA</option>
                        <option>IRACEMA</option>
                        <option>PARAISO</option>
                        <option>CASTELO</option>
                        <option>LAMEIRÃO</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="documento">CPF</label>
                    <input type="text" class="form-control" id="documento" name="documento" oninput="mascaraCPF(event)">
                </div>
                <div class="form-group col-md-4">
                    <label for="dataNascimento">Data Nascimento</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-4">
                    <label for="dataBatismo">Data Batismo</label>
                    <input type="date" class="form-control" id="dataBatismo" name="dataBatismo">
                </div>
                <div class="form-group col-md-4">
                    <label for="data_Consagracao">Data Consagração</label>
                    <input type="date" class="form-control" id="data_Consagracao" name="data_Consagracao">
                </div>
                <div class="form-group col-md-4">
                    <label for="estadoCivil">Estado Civil</label>
                    <select class="form-select" id="estadoCivil" name="estadoCivil">
                        <option>Selecione</option>
                        <option>Casado</option>
                        <option>Casada</option>
                        <option>Solteiro</option>
                        <option>Solteira</option>
                        <option>Divorciado</option>
                        <option>Divorciada</option>
                        <option>Viuvo</option>
                        <option>Viuva</option>
                        <option>Separado</option>
                        <option>Separada</option>
                    </select>
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-6">
                    <label for="mae">Nome da Mãe</label>
                    <input type="text" class="form-control" id="mae" name="mae" onkeyup="maiuscula(this)">
                </div>
                <div class="form-group col-md-6">
                    <label for="pai">Nome do Pai</label>
                    <input type="text" class="form-control" id="pai" name="pai" onkeyup="maiuscula(this)">
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-12">
                    <label for="arquivo" class="form-label">Cadastrar Imagem</label>
                    <input type="file" class="form-control" id="arquivo" name="arquivo" accept="image/*">
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-4">
                    <label for="logradouro">Logradouro</label>
                    <select class="form-select" id="logradouro" name="logradouro">
                        <option>Selecione</option>
                        <option>Rua</option>
                        <option>Avenida</option>
                        <option>Fazenda</option>
                        <option>Rodovia</option>
                        <option>Travessa</option>
                        <option>Povoado</option>
                        <option>Distrito</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" onkeyup="maiuscula(this)">
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero">
                </div>
            </div>

            <div class="row d-none">
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" onkeyup="maiuscula(this)">
                </div>
                <div class="form-group col-md-4">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" onkeyup="maiuscula(this)">
                </div>
                <div class="form-group col-md-4">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" oninput="mascaraCEP(event)">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                </div>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script>
    function maiuscula(z) {
        z.value = z.value.toUpperCase();
    }

    function mascaraCPF(event) {
        let input = event.target;
        input.value = input.value.replace(/\D/g, '');
        input.value = input.value.replace(/(\d{3})(\d)/, '$1.$2');
        input.value = input.value.replace(/(\d{3})(\d)/, '$1.$2');
        input.value = input.value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    function mascaraCEP(event) {
        let input = event.target;
        input.value = input.value.replace(/\D/g, '');
        input.value = input.value.replace(/(\d{5})(\d)/, '$1-$2');
    }
    </script>
</body>

</html>