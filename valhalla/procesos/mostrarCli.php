<?php
  include '../../conexionDB.php';
  $seleccionar = "SELECT clientes.id, clientes.dni, clientes.apellido, clientes.nombre, clientes.fecha_p, clientes.fecha_v, clientes.plan_id, planes.nombre AS planes FROM clientes INNER JOIN planes ON planes.id = clientes.plan_id ORDER BY id";

  if (isset($_POST['mostrar'])){
?>
      <h1>Clientes</h1>
				<hr>
				<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNewClient'>Agregar cliente <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="M4.5 8.552c0 1.995 1.505 3.5 3.5 3.5s3.5-1.505 3.5-3.5-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5zM19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2z"></path></svg></button>
				<br><br>
				<table class='table table-sm'>
  			<thead>
					<tr>
						<th>#</th>
						<th>Dni</th>
						<th>Apellido</th>	
						<th>Nombre</th>	
						<th>Ingreso</th>	
						<th>Vencimiento</th>	
						<th>Plan</th>	
            <th>Eliminar</th>	
					</tr>
  			</thead>
  			<tbody>
<?php
  $resultado = $conexion->query($seleccionar);
  while($fila = $resultado->fetch_assoc()){
?>
  <tr>
		<td id="idc">
    <?php echo $fila['id'] ?>
    </td>
		<td><?php echo $fila['dni'] ?></td>
		<td><?php echo $fila['apellido'] ?></td>
		<td><?php echo $fila['nombre'] ?></td>
		<td><?php echo $fila['fecha_p'] ?></td>
		<td><?php echo $fila['fecha_v'] ?></td>	
		<td><?php echo $fila['plan_id'] ?></td>	

		<td>
      <button onclick="si_no_delete(<?php echo $fila['id'] ?>)" 
      type='button' 
      class='btn btn-danger btn-desktop'>Eliminar <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg></button>

      <button onclick="si_no_delete(<?php echo $fila['id'] ?>)" 
      type='button' 
      class='btn btn-danger btn-mobil'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg></button>
		</td>

	</tr>
<?php
  }
} 
?>