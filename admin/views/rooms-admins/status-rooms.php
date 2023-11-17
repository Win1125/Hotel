<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	if (isset($_POST['submit'])) {
		$status = $_POST['status'];

		$update = $conn->prepare("UPDATE rooms SET id_status = :status WHERE id_room = '$id'");

		$update->execute([
			":status" => $status
		]);

		echo	"<script>
						Swal.fire({
							icon : 'info',
							title: 'Actualización Exitosa',
							text: 'Habitación actualizado',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='show-rooms.php';
							}
						});
					</script>";
	}
}

?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Update Status</h5>
				<form method="POST" action="status-rooms.php?id=<?php echo $id ?>">
					<select name="status" style="margin-top: 15px;" class="form-control">
						<option>Choose Status</option>
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select>
					<!-- Submit button -->
					<button style="margin-top: 10px;" type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../../layouts/footer.php'); ?>