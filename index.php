<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Nombre Dueño" autofocus>
          </div>
          <div class="form-group">
            <textarea name="objeto" rows="2" class="form-control" placeholder="Objeto"></textarea>
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" placeholder="Descripcion"></textarea>
          </div>
          <div class="form-group">
            <input type= "file" name="imagen">
          </div>
          <div class="form-group">
            <textarea name="correo" rows="2" class="form-control" placeholder="correo"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar">
          <a href="https://www.youtube.com/watch?v=02M9bLDUizI" class="btn btn-primary btn-block">Ver Tabla</a>
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Dueño</th>
            <th>Objeto</th>
            <th>Descripcion</th>
            <th>imagen</th>
            <th>Correo</th>
            <th>Fecha creado</th>
            <th>Editar/Borrar</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['objeto']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
              <a href="<?php echo $row['imagen']; ?>" target="_blank">
              <img src="<?php echo $row['imagen']; ?>" alt="Imagen" style="max-width: 100px; max-height: 100px;">
              </a>
            </td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>