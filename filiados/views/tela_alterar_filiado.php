<?php
session_start();
include 'verifica_acesso.php';
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:login.php');
}
?>

<?php
require '../../db/config.php';

$matricula = $_GET['matricula'];

$sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
$sql = $pdo->query($sql);
if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $resultado) {
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Alterar Filiado</title>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
    }

    .container {
        max-width: 900px;
        margin: 20px auto;
    }

    .form-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group label {
        font-weight: 500;
    }

    .btn-custom {
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-primary {
        background-color: #0095f6;
        border-color: #0095f6;
    }

    .btn-primary:hover {
        background-color: #0078d4;
        border-color: #0078d4;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
    }

    .form-group img {
        border-radius: 50%;
        object-fit: cover;
    }

    .text-muted {
        color: #888;
    }

    @media (max-width: 768px) {
        .row.mb-3 {
            margin-right: 0;
            margin-left: 0;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                Formulário de Alterações no cadastro
            </div>
            <form id="frmRegistro" name="frmRegistro" action="../processamento/alterar_foto_filiado.php" method="POST"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="arquivo" class="form-label">Alterar somente a foto</label>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <img src="../../imagens/<?php echo($resultado['arquivo']); ?>" width="100"
                                height="100" class="img-fluid">
                        </div>
                    </div>
                    <input type="file" class="form-control" id="arquivo" name="arquivo" required>
                </div>
                <input type="hidden" name="matricula" value="<?php echo htmlspecialchars($resultado['matricula']); ?>">
                <button type="submit" class="btn btn-secondary btn-custom">Trocar a foto</button>
            </form>

            <hr>
            <form id="frmRegistro" name="form1" action="../processamento/alterar_info_filiado.php" method="POST">
                <div class="mb-3">
                    <h4 class="form-header">Alterar Somente informações</h4>
                    <input type="hidden" name="matricula" value="<?php echo $resultado['matricula'] ?>">
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" onkeyup="maiuscula(this)"
                                value="<?php echo $resultado['nome'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="nome_carteira" class="form-label">Nome Carteira</label>
                            <input type="text" class="form-control" id="nome_carteira" name="nome_carteira"
                                onkeyup="maiuscula(this)" value="<?php echo $resultado['nome_carteira'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="funcao" class="form-label">Função</label>
                            <select class="form-select" id="funcao" name="funcao">
                                <option value="<?php echo $resultado['funcao'] ?>" selected>
                                    <?php echo $resultado['funcao'] ?></option>
                                <option>Novo Convertido</option>
                                <option>Congregado</option>
                                <option>Membro</option>
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
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="documento" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="documento" name="documento"
                                value="<?php echo $resultado['documento'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="dataNascimento" class="form-label">Data Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                                value="<?php echo $resultado['dataNascimento'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="dataBatismo" class="form-label">Data Batismo</label>
                            <input type="date" class="form-control" id="dataBatismo" name="dataBatismo"
                                value="<?php echo $resultado['dataBatismo'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="data_Consagracao" class="form-label">Data Consagração</label>
                            <input type="date" class="form-control" id="data_Consagracao" name="data_Consagracao"
                                value="<?php echo $resultado['data_Consagracao'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="estadoCivil" class="form-label">Estado Civil</label>
                            <select class="form-select" id="estadoCivil" name="estadoCivil">
                                <option value="<?php echo $resultado['estadoCivil'] ?>" selected>
                                    <?php echo $resultado['estadoCivil'] ?></option>
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
                        <div class="col-md-4 col-12 mb-3">
                            <label for="mae" class="form-label">Nome da Mãe</label>
                            <input type="text" class="form-control" id="mae" name="mae" onkeyup="maiuscula(this)"
                                value="<?php echo $resultado['mae'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="pai" class="form-label">Nome do Pai</label>
                            <input type="text" class="form-control" id="pai" name="pai" onkeyup="maiuscula(this)"
                                value="<?php echo $resultado['pai'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="datCadastro" class="form-label">Data do Cadastro</label>
                            <input type="date" class="form-control" id="datCadastro" name="datCadastro"
                                value="<?php echo $resultado['datCadastro'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <select class="form-select" id="logradouro" name="logradouro">
                                <option value="<?php echo $resultado['logradouro'] ?>" selected>
                                    <?php echo $resultado['logradouro'] ?></option>
                                <option>Rua</option>
                                <option>Avenida</option>
                                <option>Fazenda</option>
                                <option>Rodovia</option>
                                <option>Travessa</option>
                                <option>Povoado</option>
                                <option>Distrito</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco"
                                onkeyup="maiuscula(this)" value="<?php echo $resultado['endereco'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero"
                                value="<?php echo $resultado['numero'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" onkeyup="maiuscula(this)"
                                value="<?php echo $resultado['bairro'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep"
                                value="<?php echo $resultado['cep'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" onkeyup="maiuscula(this)"
                                value="<?php echo $resultado['cidade'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="uf" class="form-label">UF</label>
                            <select class="form-select" id="uf" name="uf">
                                <option value="<?php echo $resultado['uf'] ?>" selected><?php echo $resultado['uf'] ?>
                                </option>
                                <option>AC</option>
                                <option>AL</option>
                                <option>AM</option>
                                <option>AP</option>
                                <option>BA</option>
                                <option>CE</option>
                                <option>DF</option>
                                <!-- Adicione mais estados se necessário -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-12">
                            <label for="congregacao">Congregação</label>
                            <select class="form-select" id="congregacao" name="congregacao">
                                <option>Selecione</option>
                                <option value="<?php echo $resultado['congregacao'] ?>" selected>
                                    <?php echo $resultado['congregacao'] ?></option>
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
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone"
                                value="<?php echo $resultado['telefone'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?php echo $resultado['email'] ?>">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="<?php echo $resultado['status'] ?>" selected>
                                    <?php echo $resultado['status'] ?></option>
                                <option>Ativo</option>
                                <option>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <img src="../views/tela_alterar_filiado.php" alt="">
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-custom">Alterar</button>
                        <a href="javascript:history.back()" class="btn btn-secondary btn-custom">Voltar</a>
                    </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
    // Função de máscara maiúscula
    function maiuscula(z) {
        z.value = z.value.toUpperCase();
    }
    </script>
</body>

</html>