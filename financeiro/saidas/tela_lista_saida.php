<?php
session_start();
include 'verifica_acesso.php';
// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

require '../../db/config.php';

// Parâmetros da paginação
$porPagina = 10; // Quantidade de resultados por página
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual, padrão é 1
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';
// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM saidas")->fetchColumn();

// Cálculo para determinar o número total de páginas
$totalPaginas = ceil($totalRegistros / $porPagina);

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta com LIMIT para a paginação
if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sql = "SELECT * FROM saidas LIMIT $indiceInicio, $porPagina";
    $query = $pdo->query($sql);
} else {
    $sql = "SELECT * FROM saidas WHERE congregacao = :congregacao LIMIT $indiceInicio, $porPagina";
    $query = $pdo->prepare($sql);
    $query->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
    $query->execute();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* Estilização da tabela */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto; /* Centraliza a tabela horizontalmente */
            align-items: center; /* Centraliza verticalmente */
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .table tr:hover {
            background-color: #e0e0e0;
        }

        /* Estilização da tabela responsiva */
        .table-responsive {
            overflow: auto;
            border: 1px solid #FF4500;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Saídas</h1>
        <a href="tela_cadastro.php">Cadastro</a>
        <hr style="border: 1px solid #008000;">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Data Saída</th>
                                <th>Valor</th>
                                <th>Responsável</th>
                                <th>Congregação</th>
                                <th>Descrição</th>
                                <th>Excluir</th>
                                <th>Alterar</th>
                                <th>Comprovante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($query) && $query->rowCount() > 0) {
                                foreach ($query->fetchAll() as $linhas) {
                                    ?>
                                    <tr>
                                        <td><?php echo $linhas['id']; ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($linhas['datasaida'])); ?></td>
                                        <td><?php echo $linhas['valor']; ?></td>
                                        <td><?php echo $linhas['responsavel']; ?></td>
                                        <td><?php echo $linhas['congregacao']; ?></td>
                                        <td><?php echo $linhas['descricao']; ?></td>
                                        <td>
                                            <a href="procedimento_excluir_saida.php?id=<?php echo $linhas['id']; ?>">
                                                <img src="../../imagens/diversas_imagens/excluir.png" width="25" height="20">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tela_alterar_saida.php?id=<?php echo $linhas['id']; ?>">
                                                <img src="../../imagens/diversas_imagens/editar.png" width="25" height="20">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tela_comprovante_saida.php?id=<?php echo $linhas['id']; ?>">
                                                <img src="../../imagens/diversas_imagens/download.png" width="25" height="20">
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- Linha 1 -->
        <br>                    
        <!-- Paginação -->
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination">
                    <?php
                    for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                        echo "<li class='page-item'><a class='page-link' href='?pagina=$pagina&congregacao=$congregacao'>$pagina</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!-- fim do Conteiner_principal -->
</body>

</html>



