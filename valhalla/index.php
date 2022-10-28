<?php
session_start();
error_reporting(0);
include '../conexionDB.php';
$usuario = $_SESSION['usuario'];

if(!isset($usuario)){
  header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <!-- ESTILOS ALERTIFY -->
  <link rel="stylesheet" type="text/css" href="./alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="./alertify/css/themes/default.css">
  <title>Valhalla</title>
  <!-- JQUERY -->
  <script type="text/javascript" src="./js/jquery-3.6.1.min.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- ALERTIFY JS -->
  <script src="./alertify/alertify.js"></script>
  <!-- SCRIPT PERSONAL -->
  <script src="./js/main.js"></script>
  <!-- ESTILOS PERSONALES -->
</head>
<body>
  <header>
    <nav>
      <div class="logo">
        <a href="#">Valhalla</a>
      </div>
      <a href="../cerrarSesión.php">Cerrar Sesión</a>
    </nav>
  </header>
  <!-- MODAL PARA AGREGAR UN NUEVO CLIENTE ⬇⬇⬇⬇⬇⬇ -->
  <div class="modal fade" id="modalNewClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalNewClientLabel" aria-hidden="true">
      <div class="modal-dialog">
        <!-- CONTENIDO DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
        <div class="modal-content">
          <!-- CABECERA DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
          <div class="modal-header">
            <!-- TITULO DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
            <h5 class="modal-title" id="modalNewClientLabel">Agregar nuevo cliente</h5>
            <!-- BOTON PARA CERRAR EL MODAL ⬇⬇⬇⬇⬇⬇ -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- CUERPO DEL MODAL ⬇⬇⬇⬇⬇⬇ -->
          <div class="modal-body">
            <!-- FORMULARIO PARA AGREGAR NUEVO CLIENTE ⬇⬇⬇⬇⬇⬇-->
            <form method="POST" enctype="multipart/form-data">
              <!-- id del cliente -->
              <input type="hidden" id="idCliente">

                <label for="dniCliente">DNI del Cliente:</label><label id="alertDniC"></label>
                <input type="text" name="dniC" id="dniCliente" class="form-control">

                <label for="apellidoCliente">Apellido del Cliente:</label><label id="alertApellidoC"></label>
                <input type="text" name="apellidoC" id="apellidoCliente" class="form-control">
                
                <label for="nombreCliente">Nombre del Cliente:</label><label id="alertNombreC"></label>
                <input type="text" name="nombreC" id="nombreCliente" class="form-control">

                <label for="categoria">Plan:</label><label id="alertPlanC"></label>
                <select name="planC" id="planCliente" class="form-control">
                        <!-- INCLUIMOS EL CODIGO PARA MOSTRAR LOS PLANES ⬇⬇⬇⬇ -->
                        <?php
                        // trae la conexion ⬇⬇⬇⬇
                        include "../conexionDB.php";
                        //me permite trabajar con caracteres españoles ⬇⬇⬇⬇
                        $acentos = $conexion->query("SET NAMES 'utf8'");
                        //selecciona todo los registros de la tabla PLANES ⬇⬇⬇⬇
                        $SQL = "SELECT * FROM planes";
                        //verifica y ejecuta la SQL ⬇⬇⬇⬇
                        if (!$respuesta = $conexion->query($SQL)) {
                          //si algo esta mal lo informa ⬇⬇⬇⬇
                          echo $conexion->error;
                        }
                      
                        //mientras tenga registros la variable "respuesta" ⬇⬇⬇⬇
                        //se guarda en la variable "dato" cada uno de los campos ⬇⬇⬇⬇
                        while ($dato = $respuesta->fetch_assoc()) {
                          //genera los option dependiendo de los datos de la tabla planes ⬇⬇⬇⬇
                          echo "<option value='" . $dato["id"] . "'>" . $dato["nombre"] . "</option>";
                        }
                        ?>
                </select>

                <div class="modal-footer">
                  <!-- BOTON PARA CANCELAR -->
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                  <!-- BOTON PARA AGREGAR CLIENTE -->
                  <button type="submit" class="btn btn-primary" onclick="agregarCliente()">Agregar</button>
                </div>
            </form>
          </div>
          <!-- PIE DEL MODAL -->
        </div>
      </div>
    </div>
  

  
    <div class="container">
    <div id="registros"></div>
  </div>
</body>
</html>