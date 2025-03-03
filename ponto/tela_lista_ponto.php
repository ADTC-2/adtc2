<?php
session_start();
if (!isset($_SESSION['nome']) and !isset($_SESSION['senha']))
{
    //Limpa
    unset ($_SESSION['nome']);
    unset ($_SESSION['senha']);

    //Redireciona para a página de autenticação
    header('location:login.php');
}
?>

<?php
require_once "../db/config.php";

// Parâmetros da paginação
$porPagina = 10; // Quantidade de resultados por página
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual, padrão é 1

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM ponto")->fetchColumn();

// Cálculo para determinar o número total de páginas
$totalPaginas = ceil($totalRegistros / $porPagina);

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta com LIMIT para a paginação
$sql = "SELECT * FROM ponto LIMIT $indiceInicio, $porPagina";
$query = $pdo->query($sql);
?>
    <style>
        .pagination {
            margin-top: 20px;
        }

        .pagination li {
            display: inline;
            margin-right: 5px;
        }

        .pagination li a {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            color: #333;
            text-decoration: none;
        }

        .pagination li.active a {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <head>
    <!-- ... outras tags head ... -->
    <style>
        /* Estilização da tabela */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto; /* Centraliza a tabela horizontalmente */
            align-items: center; /* Centraliza verticalmente */
           
        }

        .table th, .table td {
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
    <style>
       #img_foto {
        width: 200px; /* Largura desejada */
         height: auto; /* Altura automática para manter a proporção original */
              }
</style>
</head>

<div class="container">
    <h1>Controle QRcode</h1>
    <a href="buscar.php">Tela Cadastro</a>
    <hr style="border:1px solid #008000;">

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive" style="overflow: auto;border:solid 1px #FF4500;margin-top:10px;">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Nome</th>
                        <th>Funcao</th>
                        <th>Congragação</th>
                        <th>Data Cadastro</th>
                        <th>Imagem</th>
                        <th>Excluir</th>                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($query->rowCount() > 0) {
                        foreach ($query->fetchAll() as $linhas) {
                            ?>
                            <tr>
                                <td><?php echo $linhas['matricula']; ?></td>
                                <td><?php echo $linhas['nome']; ?></td>
                                <td><?php echo $linhas['funcao']; ?></td>
                                <td><?php echo $linhas['congregacao']; ?></td>
                                <td><?php echo $linhas['dataCadastro']; ?></td>
                                <td>                                   
                                <img id="img_foto" width="25" height="20" src="../ponto/img_qrcode/<?php echo $linhas['arquivo'];?>">
                                </td>
                                <td>                                   
                                    <a href="procedimento_excluir_ponto.php?matricula=<?php echo $linhas['matricula']; ?>"><img src="../imagens/diversas_imagens/excluir.png"width="25" height="20"></a>
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

    <!-- Paginação -->
    <div class="row">
        <div class="col-md-12">
            <ul class="pagination">
                <?php
                for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                    echo "<li><a href='?pagina=$pagina'>$pagina</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div><!-- fim do Conteiner_principal -->


<?php require'footer.php';?>