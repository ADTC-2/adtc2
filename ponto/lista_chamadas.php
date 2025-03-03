<?php
require_once '../vendor/autoload.php';
require_once '../db/config.php';

try {
    // Obtém o conteúdo do QR code da URL
    $matriculaLida = $_GET['conteudo'];

    // Conecte-se ao banco de dados usando as configurações do arquivo de configuração
    $conexao = new mysqli($host, $usuario, $senha, $banco);

    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Consulta SQL para buscar dados usando a matrícula
    $consulta = "SELECT matricula, nome, presente, ausente, dataAtual FROM ponto WHERE matricula = '$matriculaLida'";
    $resultado = $conexao->query($consulta);

    // Verifica se a consulta foi bem-sucedida
    if ($resultado->num_rows > 0) {
        // Início da tabela HTML
        echo "<table border='1'>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Presente</th>
                    <th>Ausente</th>
                    <th>Data Atual</th>
                </tr>";

        // Obtém os dados do banco de dados e exibe na tabela HTML
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$linha['matricula']}</td>
                    <td>{$linha['nome']}</td>
                    <td>{$linha['presente']}</td>
                    <td>{$linha['ausente']}</td>
                    <td>{$linha['dataAtual']}</td>
                </tr>";
        }

        // Fim da tabela HTML
        echo "</table>";
    } else {
        echo "Matrícula não encontrada no banco de dados.";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} catch (Exception $e) {
    echo "Erro ao ler o QR code: " . $e->getMessage();
}
?>
