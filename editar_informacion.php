<?php
include("db.php");
$title = '';
$objeto = '';
$description = '';
$imagen = '';
$correo = '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM task WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['title'];
    $objeto = $row['objeto'];
    $description = $row['description'];
    $imagen = $row['imagen'];
    $correo = $row['correo'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $title = $_POST['title'];
  $objeto = $_POST['objeto'];
  $description = $_POST['description'];
  $correo = $_POST['correo'];

  // Manejo de la imagen (similar al código en save_task.php)
  $imagen_link = $imagen;  // Mantén el enlace actual si no se actualiza la imagen

  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "imagen/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
      $imagen_link = $target_file;
    } else {
      $_SESSION['message'] = 'Error al cargar la nueva imagen.';
      $_SESSION['message_type'] = 'danger';
      header("Location: edit.php?id=$id");
      exit();
    }
  }

  // Actualiza los datos en la base de datos
  $query = "UPDATE task SET title = '$title', objeto = '$objeto', description = '$description', imagen = '$imagen_link', correo = '$correo' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se editó exitosamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
          </div>
          <div class="form-group">
            <textarea name="objeto" class="form-control" cols="30" rows="10"><?php echo $objeto; ?></textarea>
          </div>
          <div class="form-group">
            <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description; ?></textarea>
          </div>
          <div class="form-group">
            <input type="file" name="imagen" accept="image/*">
          </div>
          <div class="form-group">
            <textarea name="correo" class="form-control" cols="30" rows="10"><?php echo $correo; ?></textarea>
          </div>
          <button class="btn-success" name="update">
            Guardar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>