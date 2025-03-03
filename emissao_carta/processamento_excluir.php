<?php
session_start();
include '../db/config.php'; // Include the database connection

$response = array('success' => false);

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM emitir WHERE id_emissao = :id";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $response['success'] = true;
        }
        
        $stmt->closeCursor(); // Close the cursor instead of closing the statement
    }
}

echo json_encode($response);
?>
