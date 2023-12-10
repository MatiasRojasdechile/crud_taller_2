<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  
  <div class="row justify-content-center">
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
              <textarea name="objeto" rows="2" class="form-control" placeholder="Objeto"></textarea>
            </div>
            <div class="form-group">
              <textarea name="descripcion" rows="3" class="form-control" placeholder="Descripcion"></textarea>
            </div>
            <div class="form-group">
              <input type= "file" name="imagen">
            </div>
            <div class="form-group">
              <textarea name="guardia" rows="2" class="form-control" placeholder="Guardia"></textarea>
            </div>
            <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar">
            <a href="tabla.php" class="btn btn-primary btn-block">Ver Tabla</a>
          </form>
      </div>
    </div>
    
  </div>
</main>

<?php include('includes/footer.php'); ?>