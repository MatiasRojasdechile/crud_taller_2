<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_task'])) {
    $title = $_POST['title'];
    $objeto = $_POST['objeto'];
    $description = $_POST['description'];
    $correo = $_POST['correo'];

    // Manejo del archivo
    $imagen_link = '';  // Inicializa la variable de enlace de imagen

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "imagen/";  // Directorio de carga 
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        
        // Mueve el archivo al directorio de carga
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen_link = $target_file;
        } else {
            $_SESSION['message'] = 'Error al cargar la imagen.';
            $_SESSION['message_type'] = 'danger';
            header('Location: index.php');
            exit();
        }
    }

    // Inserta los datos en la base de datos
    $query = "INSERT INTO task (title, objeto, description, imagen, correo) VALUES ('$title', '$objeto', '$description', '$imagen_link', '$correo')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $_SESSION['message'] = 'Error al guardar la tarea.';
        $_SESSION['message_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Tarea guardada exitosamente.';
        $_SESSION['message_type'] = 'success';
    }

    header('Location: index.php');
    exit();
}
?>