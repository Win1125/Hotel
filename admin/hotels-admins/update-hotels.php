<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$hotel = $conn->query("SELECT * FROM hotels WHERE id_hotel = '$id'");
	$hotel->execute();

	$hotelSingle = $hotel->fetch(PDO::FETCH_OBJ);

	if (isset($_POST['submit'])) {

		if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['location'])) {
			echo "<script type='text/javascript'>
					Swal.fire({
						icon : 'error',
						title: 'Ocurrió un error inesperado',
						text: 'No has llenado todos los campos que son requeridos',
						type: 'error',
						confirmButtonText: 'Aceptar'
					});
				  </script>";
		} else {

			$name = $_POST['name'];
			$description = $_POST['description'];
			$location = $_POST['location'];

			$update = $conn->prepare("UPDATE hotels SET name = :name, description = :description, location = :location WHERE id_hotel = '$id'");

			$update->execute([
				":name" => $name,
				":description" => $description,
				":location" => $location
			]);

			if($update){
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
}
?>


<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Update Hotel</h5>
				<form method="POST" action="update-hotels.php?id=<?php echo $id; ?>">
					<div class="form-outline mb-4 mt-4">
						<label for="idHotel">ID Hotel</label>
						<input type="text" value="<?php echo $hotelSingle->id_hotel; ?>" name="id" id="idHotel" class="form-control" placeholder="id" readonly />
					</div>

					<div class="form-outline mb-4 mt-4">
						<label for="form2Example1">Name Hotel</label>
						<input type="text" value="<?php echo $hotelSingle->name; ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
					</div>

					<div class="form-group">
						<label for="exampleFormControlTextarea1">Description</label>
						<textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $hotelSingle->description; ?></textarea>
					</div>

					<div class="form-outline mb-4 mt-4">
						<label for="exampleFormControlTextarea1">Location</label>
						<input value="<?php echo $hotelSingle->location; ?>" type="text" name="location" id="form2Example1" class="form-control" />
					</div>


					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../layouts/footer.php'); ?>