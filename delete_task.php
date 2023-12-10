<?php

include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Modificar la consulta para actualizar el estado a 0 en lugar de eliminar
    $query = "UPDATE task SET estado = 0 WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed.");
    }

    $_SESSION['message_type'] = 'danger';
    header('Location: tabla.php');
}

?>