<?php
require '../../conexionDB.php';

if (isset($_POST['idClienteD'])) {
  $id = $_POST['idClienteD'];
  $SQL = "DELETE FROM clientes WHERE id = '$id'";
  $resultado = $conexion->query($SQL);
}