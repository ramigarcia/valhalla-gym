<?php
$conexion = new mysqli("localhost", "root", "", "valhalla-gym");

$dni = $conexion->real_escape_string($_REQUEST['dniC']);
$apellido = $conexion->real_escape_string($_REQUEST['apellidoC']);
$nombre = $conexion->real_escape_string($_REQUEST['nombreC']);
$plan = $conexion->real_escape_string($_REQUEST['planC']);
$insert = "INSERT INTO clientes(dni, apellido, nombre, fecha_p, fecha_v, plan_id) VALUES ('$dni', '$nombre', '$apellido', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '$plan')";

$ejecut = $conexion->query($insert);


?>