<?php
include('../includes/db.php'); // Incluir la conexión a la base de datos

if (isset($_POST['id'])) {
    $id_comentario = $_POST['id'];

    // Eliminar el comentario de la base de datos
    $sql_delete = "DELETE FROM comentarios WHERE id = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id', $id_comentario, PDO::PARAM_INT);

    if ($stmt_delete->execute()) {
        // Respuesta en formato JSON indicando éxito
        echo json_encode(['success' => true]);
    } else {
        // Respuesta en formato JSON indicando error
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
