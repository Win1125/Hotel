<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

$st = $conn->query(" SELECT * FROM status WHERE name in ('Confirmado', 'Pendiente', 'Finalizado')");
$st->execute();

$allStatus = $st->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	if (isset($_POST['submit'])) {

		$status = $_POST['status'];

		$update = $conn->prepare("UPDATE booking SET id_status = :status WHERE id_booking = '$id'");

		$update->execute([
			":status" => $status
		]);
		
		if ($status == "Finalizado") {
			echo	"<script>
						Swal.fire({
							icon : 'info',
							title: 'Actualización Exitosa',
							text: 'La Reserva ha finalizado con Exito! Recuerda que no se podrá cambiar',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='show-bookings.php';
							}
						});
					</script>";
		} else {
			echo	"<script>
						Swal.fire({
							icon : 'info',
							title: 'Actualización Exitosa',
							text: 'Reserva actualizada',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='show-bookings.php';
							}
						});
					</script>";
		}
	}
}

?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Update Status</h5>
				<form method="POST" action="status-bookings.php?id=<?php echo $id ?>">
					<select name="status" style="margin-top: 15px;" class="form-control">
						<option>Escoge un Estado</option>
						<?php foreach ($allStatus as $s): ?>
							<option value="<?php echo $s -> id_status; ?>"><?php echo $s -> name; ?></option>
						<?php endforeach; ?>
					</select>
					<!-- Submit button -->
					<button style="margin-top: 10px;" type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../../layouts/footer.php'); ?>