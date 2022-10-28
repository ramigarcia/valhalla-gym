<?php
session_start();
error_reporting(0);

include './conexionDB.php';
if(isset($_POST['entrar'])){
  // RECIBO EL USUARIO Y CONTRASEÑA
  $user = $conexion->real_escape_string($_POST['usuario']);
  $password = $conexion->real_escape_string($_POST['pss']);

  // CREO LA CONSULTA PARA PODER OBTENER LOS CAMPOS DE LA TABLA USUARIOS
  $consulta= "SELECT * FROM adminv WHERE usuario = '$user' AND contraseña = '$password'";
  // EJECUTO LA CONSULTA Y LA GUARDO EL RESULTADO EN UNA VARIABLE
  $resultado = $conexion->query($consulta);

  // SI LA CONSULTA SE EJECUTO CON EXITO
  if($resultado){
    // MIENTRAS QUE LA CONSLTA TENGA FILAS PARA DEVOLVER
    while($row = $resultado->fetch_array()){
      // OBTENGO LOS DATOS USUARIO CONTRASEÑA Y TIPO DE USUARIO
      $userOk = $row['usuario'];
      $passwordOk = $row['contraseña'];
    }
    // CIERRO LA CONSULTA
    $resultado->close();
  }$conexion->close();
  
  // SI ESXISTE USUARIO Y CONTRASEÑA
  if(isset($user) && isset($password)){
    // COMPARO LOS VALORES INGRESADO POR EL USUARIO CON LOS DE LA BASE DE DATOS
    // SI ESTOS EXISTEN
    if($user === $userOk && $password === $passwordOk){
      $_SESSION['login'] = TRUE;
      // GUARDAMOS EL NOMBRE DEL USUARIO EN LA VARIABLE SESSION
      $_SESSION['usuario'] = $user;
      header("location: ./valhalla/");
    }else{
      $mensaje = "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>O no !!</strong> Tus datos no son correctos.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      session_unset();
      session_destroy();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <title>Login</title>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <div class="logo">
      <img src="./img/valhalla-vikingo-n-bg.png" width="140" height="140" alt="logo-del-valhalla">
    </div>
  </header>
  <main>
    <div class="container">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
          <legend>Inicia Sesión</legend>
          <label for="usuario" class="form-label">
            <span>Usuario:</span>
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingresa tu usuario">
          </label>
          <label for="pss" class="form-label">
            <span>Contraseña:</span>
            <input type="password" class="form-control" name="pss" id="pss" placeholder="Ingresa tu contraseña">
          </label>
          <button type="submit" name="entrar" class="btn btn-primary">Iniciar</button>
        </fieldset>
      </form>
      <?php echo $mensaje;?>
    </div>
  </main>
</body>
</html>