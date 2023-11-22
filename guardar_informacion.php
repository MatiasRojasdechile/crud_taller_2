<?php

include('db.php');

if (isset($_POST['save_task'])) {
  $title = $_POST['title'];
  $objeto = $_POST['objeto'];
  $description = $_POST['description'];
  $imagen = $_POST['imagen'];
  $correo = $_POST['correo'];
  $query = "INSERT INTO task(title, objeto ,description, imagen, correo) VALUES ('$title','$objeto','$description','$imagen','$correo')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo exitosamente';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>