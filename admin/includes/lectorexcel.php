<?php

require_once ("_db.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=lector.xls");
?>


<table class="table table-striped table-dark " id= "table_id">

                   
<thead>    
<tr>
<th>Nombre</th>
<th>Correo</th>
<th>Telefono</th>
<th>Fecha</th>
<th>Rol</th>


</tr>
</thead>
<tbody>

<?php

$conexion=mysqli_connect("localhost","root","","r_user");               
$SQL="SELECT user.id, user.nombre, user.correo, user.password, user.telefono,
user.fecha, permisos.rol FROM user
LEFT JOIN permisos ON user.rol = permisos.id";
$dato = mysqli_query($conexion, $SQL);

if($dato -> num_rows >0){
while($fila=mysqli_fetch_array($dato)){

?>
<tr>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['correo']; ?></td>
<td><?php echo $fila['telefono']; ?></td>
<td><?php echo $fila['fecha']; ?></td>
<td><?php echo $fila['rol']; ?></td>



<?php
}

}
