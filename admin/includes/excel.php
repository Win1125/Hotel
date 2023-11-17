<?php

require_once ("_db.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
?>


<table class="table table-striped table-dark " id= "table_id">

                   
<thead>    
<tr>
<th>ID Booking</th>
<th>Check In</th>
<th>Check Out</th>
<th>Habitacion</th>
<th>Precio</th>
<th>Hotel</th>
<th>Locacion</th>

</tr>
</thead>
<tbody>

<?php

$conexion=mysqli_connect("localhost","root","","hotel_a");               
$SQL="SELECT b.id_booking, b.check_in, b.check_out, r.room_name, r.price, h.name AS hotel_name, h.location FROM booking b
    JOIN rooms r ON b.id_room = r.id_room
    JOIN hotels h ON r.id_hotel = h.id_hotel;";
$dato = mysqli_query($conexion, $SQL);

if($dato -> num_rows >0){
while($fila=mysqli_fetch_array($dato)){

?>
<tr>
<td><?php echo $fila['id_booking']; ?></td>
<td><?php echo $fila['check_in']; ?></td>
<td><?php echo $fila['check_out']; ?></td>
<td><?php echo $fila['room_name']; ?></td>
<td><?php echo $fila['price']; ?></td>
<td><?php echo $fila['hotel_name']; ?></td>
<td><?php echo $fila['location']; ?></td>



<?php
}

}
