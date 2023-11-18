<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'php_mysql_crud'
) or die(mysqli_erro($mysqli));

?>

//-1 dominio/ip de la basedatos -2 usuario(deafult root) -3 contraseña myadmin -4 nombre archivo phpmyadmin