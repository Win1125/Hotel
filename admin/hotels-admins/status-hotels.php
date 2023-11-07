<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	if (isset($_POST['submit'])) {
		$status = $_POST['status'];

		if($status == 'null'){
			echo	"<script>
						Swal.fire({
							icon : 'error',
							title: 'Ups! Hubo un problema',
							text: 'Selecciona un estado valido',
							type: 'error'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='status-hotels.php';
							}
						});
					</script>";
		}else{
			
			$update = $conn->prepare("UPDATE hotels SET status = :status WHERE id_hotel = '$id'");

			$update->execute([
				":status" => $status
			]);

			echo	"<script>
							Swal.fire({
								icon : 'info',
								title: 'Actualización Exitosa',
								text: 'Hotel actualizado',
								type: 'success'
							}).then((result) => {
								if(result.isConfirmed){
									window.location='show-hotels.php';
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
				<form method="POST" action="status-hotels.php?id=<?php echo $id ?>">
					<!-- Email input -->
					<select name="status" style="margin-top: 15px;" class="form-control">
						<option value="null">Choose Status</option>
						<option value="1">1</option>
						<option value="0">0</option>
					</select>
					<!-- Submit button -->
					<button style="margin-top: 10px;" type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../layouts/footer.php'); ?>