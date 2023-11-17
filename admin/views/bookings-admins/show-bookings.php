<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>

<?php

$validar = $_SESSION['username'];

if (!isset($validar)) {
    echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}

$bookings = $conn->query("SELECT b.id_booking, u.username 
							AS user_name, u.email, b.phone_number, b.check_in, b.check_out, r.room_name, h.name 
							AS hotel_name, s.name AS status_name, b.payment FROM booking b 
							JOIN users u ON b.id_user = u.id_user 
							JOIN rooms r ON b.id_room = r.id_room 
							JOIN hotels h ON r.id_hotel = h.id_hotel 
							JOIN status s ON b.id_status = s.id_status;");
$bookings->execute();

$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Bookings</h5>
				<hr>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<a class="btn btn-success" href="../../includes/excel.php">Excel
								<i class="fa fa-table" aria-hidden="true"></i>
							</a>
							<a href="../../includes/reporte.php" class="btn btn-danger"><b>PDF</b></a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<a href="down-bookings.php" class="btn btn-warning text-white"><b>Informes por fecha</b></a>
						</div>
					</div>
				</div>

				<?php
				$conexion = mysqli_connect("localhost", "root", "", "hotel");
				$where = "";
				if (isset($_GET['enviar'])) {
					$busqueda = $_GET['busqueda'];
					if (isset($_GET['busqueda'])) {
						$where = "WHERE user.email LIKE'%" . $busqueda . "%' OR username  LIKE'%" . $busqueda . "%'
							OR id_user  LIKE'%" . $busqueda . "%'";
					}
				}
				?>
				<table class="table" id="table_id">
					<thead>
						<tr>
							<th scope="col">Check in</th>
							<th scope="col">Check out</th>
							<th scope="col">Email</th>
							<th scope="col">Phone</th>
							<th scope="col">Name</th>
							<th scope="col">Hotel</th>
							<th scope="col">Room</th>
							<th scope="col">Status</th>
							<th scope="col">Payment</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allBookings as $book) : ?>
							<tr>
								<td><?php echo $book->check_in; ?></td>
								<td><?php echo $book->check_out; ?></td>
								<td><?php echo $book->email; ?></td>
								<td><?php echo $book->phone_number; ?></td>
								<td><?php echo $book->user_name; ?></td>
								<td><?php echo $book->hotel_name; ?></td>
								<td><?php echo $book->room_name; ?></td>

								<td><?php if ($book->status_name == "Finalizado") { ?>
										<a class="btn btn-small btn-success" aria-disabled="true"><?php echo $book->status_name; ?> <i class="fa-solid fa-rotate-right"></i></a>
									<?php } else { ?>
										<a href="status-bookings.php?id=<?php echo $book->id_booking; ?>" class="btn btn-small btn-success"><?php echo $book->status_name; ?> <i class="fa-solid fa-rotate-right"></i></a>
									<?php } ?>
								</td>

								<td><?php echo $book->payment; ?></td>

								<!-- <td><a href="update-bookings.php?id=<?php echo $book->id_booking; ?>" class="btn btn-small btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i></a></td> -->
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script src="../../../sw/dist/sweetalert2.all.js"></script>
<script src="../../../sw/dist/sweetalert2.all.min.js"></script>
<script src="../../../sw/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="../../DataTables/js/datatables.min.js"></script>
<script type="text/javascript" src="../../DataTables/js/jquery.dataTables.min.js"></script>
<script src="../../DataTables/js/dataTables.bootstrap4.min.js"></script>

<script src="../../js/page.js"></script>
<script src="../../js/buscador.js"></script>
<script src="../../js/user.js"></script>

<?php require_once('../../layouts/footer.php'); ?>