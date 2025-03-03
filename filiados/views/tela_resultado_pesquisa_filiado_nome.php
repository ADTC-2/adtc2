<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

require_once "../../db/config.php";

// Verifica se a variável 'nome' foi passada via GET ou POST
$nome = isset($_POST['nome']) ? $_POST['nome'] : (isset($_GET['nome']) ? $_GET['nome'] : '');

if (empty($nome)) {
    echo '<div class="alert alert-danger text-center my-4">
            <p>Nome não fornecido.</p>
            <a class="btn btn-primary" href="../views/tela_controle_filiado.php">Voltar</a>
          </div>';
    exit();
}

// Prepara e executa a consulta
$sql = "SELECT * FROM filiado WHERE nome LIKE :nome";
$stmt = $pdo->prepare($sql);
$stmt->execute([':nome' => $nome . '%']);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtém o nível do usuário a partir da sessão
$user_level = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Resultado da Pesquisa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
        }
        .card-container {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            background-color: #ffffff;
            overflow: hidden;
        }
        .card-container:hover {
            transform: translateY(-5px);
        }
        .card-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #007bff;
            object-fit: cover;
            margin: 15px auto;
            display: block;
        }
        .card-body {
            text-align: center;
        }
        .card-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #003366;
        }
        .card-info {
            margin-top: 15px;
            font-size: 0.9rem;
        }
        .card-info p {
            margin: 5px 0;
        }
        .card-info strong {
            color: #004d00;
        }
        .card-buttons {
            margin-top: 15px;
        }
        .card-buttons .btn {
            margin: 5px;
            border-radius: 20px;
            padding: 8px 15px;
        }
        .btn-primary {
            background-color: #003366;
            border-color: #003366;
        }
        .btn-primary:hover {
            background-color: #002244;
            border-color: #002244;
        }
        .btn-danger {
            background-color: #cc0000;
            border-color: #cc0000;
        }
        .btn-danger:hover {
            background-color: #990000;
            border-color: #990000;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Resultados da Pesquisa</h1>
    <div class="row justify-content-center">
        <?php if (empty($results)): ?>
            <div class="alert alert-danger text-center my-4">
                <p>Filiado não encontrado.</p>
                <a class="btn btn-primary" href="../views/tela_controle_filiado.php">Voltar</a>
            </div>
        <?php else: ?>
            <?php foreach ($results as $linhas): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                    <div class="card card-container">
                        <div class="card-body">
                            <img class="card-img img-fluid" src="../../imagens/<?php echo htmlspecialchars($linhas['arquivo']); ?>" alt="Imagem do Filiado">
                            <h5 class="card-name"><?php echo htmlspecialchars($linhas['nome']); ?></h5>
                            <div class="card-info">
                                <p><strong>Matrícula:</strong> <?php echo htmlspecialchars($linhas['matricula']); ?></p>
                                <p><strong>Cargo:</strong> <?php echo htmlspecialchars($linhas['funcao']); ?></p>
                                <p><strong>Congregação:</strong> <?php echo htmlspecialchars($linhas['congregacao']); ?></p>
                                <p><strong>Documento:</strong> <?php echo htmlspecialchars($linhas['documento']); ?></p>
                                <p><strong>Data de Nascimento:</strong> <?php echo date("d/m/Y", strtotime($linhas['dataNascimento'])); ?></p>
                                <p><strong>Data do Batismo:</strong> <?php echo date("d/m/Y", strtotime($linhas['dataBatismo'])); ?></p>
                                <p><strong>Data da Consagração:</strong> <?php echo date("d/m/Y", strtotime($linhas['data_Consagracao'])); ?></p>
                                <p><strong>Estado Civil:</strong> <?php echo htmlspecialchars($linhas['estadoCivil']); ?></p>
                                <p><strong>Nome da Mãe:</strong> <?php echo htmlspecialchars($linhas['mae']); ?></p>
                                <p><strong>Nome do Pai:</strong> <?php echo htmlspecialchars($linhas['pai']); ?></p>
                                <p><strong>Cadastrado em:</strong> <?php echo date("d/m/Y", strtotime($linhas['datCadastro'])); ?></p>
                                <p><strong>Status Atual:</strong> <?php echo htmlspecialchars($linhas['status']); ?></p>
                            </div>
                            <div class="card-buttons">
                                <?php if ($_SESSION['nivel'] === 'admin'): ?>
                                    <a class="btn btn-danger" href="../../procedimentos/excluir_filiado.php?matricula=<?php echo urlencode($linhas['matricula']); ?>" onclick="return confirm('Tem certeza de que deseja excluir este filiado?');">Excluir</a>
                                <?php endif; ?>
                                <a class="btn btn-primary" href="../views/tela_alterar_filiado.php?matricula=<?php echo urlencode($linhas['matricula']); ?>">Alterar</a>
                                <a class="btn btn-secondary" href="../views/tela_controle_filiado.php">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require 'footer.php'; ?>

















 