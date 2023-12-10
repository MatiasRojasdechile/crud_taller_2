<?php
include("db.php");
$dueno = '';
$carnet = '';
$objeto = '';
$descripcion = '';
$imagen = '';
$correo = '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM task WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $dueno = trim($row['dueno']);
    $carnet = trim($row['carnet']);
    $objeto = trim($row['objeto']);
    $descripcion = trim($row['descripcion']);
    $imagen = trim($row['imagen']);
    $guardia = trim($row['guardia']);
  }
}

if (isset($_POST['update'])) {
  $dueno = trim($_POST['dueno']);
  $carnet = trim($_POST['carnet']);
  $objeto = trim($_POST['objeto']);
  $descripcion = trim($_POST['descripcion']);
  $guardia = trim($_POST['guardia']);

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
  $query = "UPDATE task SET dueno = '$dueno',carnet = '$carnet', objeto = '$objeto',descripcion = '$descripcion', imagen = '$imagen_link', guardia = '$guardia' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message_type'] = 'warning';
  header('Location: tabla.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <input name="dueno" type="text" class="form-control" value="<?php echo $dueno; ?>" placeholder="Nombre Dueño" readonly>
          </div>
          <div class="form-group">
              <textarea name="carnet" class="form-control" cols="30" rows="2" placeholder="Numero carnet" readonly><?php echo $carnet; ?></textarea>
          </div>
          <div class="form-group">
            <textarea name="objeto" class="form-control" cols="30" rows="2" placeholder="Objeto"><?php echo $objeto; ?></textarea> 
          </div>
          <div class="form-group">
            <textarea name="descripcion" class="form-control" cols="30" rows="3" placeholder="Descripcion"><?php echo $descripcion; ?></textarea>
          </div>
          <div class="form-group">
            <input type="file" name="imagen" accept="image/*">
          </div>
          <div class="form-group">
            <textarea name="guardia" class="form-control" cols="30" rows="2" placeholder="Guardia"><?php echo $guardia; ?></textarea>
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