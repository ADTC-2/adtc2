<?php
require_once '../db/config.php';

// Variável que recebe o valor de nome ou matrícula (substitua com o valor desejado)

$consulta= $_GET['consulta'];

// Consultar o banco de dados
$sql = "SELECT matricula, nome, funcao, congregacao,dataCadastro,arquivo FROM filiado WHERE nome = ? OR matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $consulta, $consulta);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Exibir os resultados
    while ($row = $result->fetch_assoc()) {
        $row["matricula"] ;
        $row["nome"];
        $row["funcao"] ;
        $row["congregacao"] 
        
    }
} else {
    echo "Nenhum resultado encontrado para a consulta: $consulta";
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>