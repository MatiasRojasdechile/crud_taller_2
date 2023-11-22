<?php
include("db.php");
$title = '';
$description= '';

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
  $title= $_POST['title'];
  $objeto= $_POST['objeto'];
  $description = $_POST['description'];
  $imagen= $_POST['imagen'];
  $correo= $_POST['correo'];

  $query = "UPDATE task set title = '$title', objeto = '$objeto', description = '$description', imagen = '$imagen', correo = '$correo' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se edito exitosamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
        </div>
        <div class="form-group">
        <textarea name="objeto" class="form-control" cols="30" rows="10"><?php echo $objeto;?></textarea>
        </div>
        <div class="form-group">
        <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description;?></textarea>
        </div>
        <div class="form-group">
        <textarea name="imagen" class="form-control" cols="30" rows="10"><?php echo $imagen;?></textarea>
        </div>
        <div class="form-group">
        <textarea name="correo" class="form-control" cols="30" rows="10"><?php echo $correo;?></textarea>
        </div>
        <button class="btn-success" name="update">
          Update
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>