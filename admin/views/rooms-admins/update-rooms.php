<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$hotel = $conn->query("SELECT * FROM rooms WHERE id_room = '$id'");
	$hotel->execute();

	$hotelSingle = $hotel->fetch(PDO::FETCH_OBJ);

	if (isset($_POST['submit'])) {

		if (empty($_POST['name']) || empty($_POST['price']) || empty($_POST['num_persons']) || empty($_POST['num_beds'])) {
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
			$price = $_POST['price'];
			$num_persons = $_POST['num_persons'];
			$num_beds = $_POST['num_beds'];

			$update = $conn->prepare("UPDATE rooms SET room_name = :name, price = :price, num_persons = :num_persons, num_beds = :num_beds WHERE id_room = '$id'");

			$update->execute([
				":name" => $name,
				"price" => $price,
				":num_persons" => $num_persons,
				":num_beds" => $num_beds
			]);

			if($update){
				echo	"<script>
						Swal.fire({
							icon : 'info',
							title: 'Actualización Exitosa',
							text: 'Habitación actualizada',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='show-rooms.php';
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
				<form method="POST" action="update-rooms.php?id=<?php echo $id; ?>">
					<div class="form-outline mb-4 mt-4">
						<label for="idHotel">ID Habitacion</label>
						<input type="text" value="<?php echo $hotelSingle->id_room; ?>" name="id" id="idHotel" class="form-control" placeholder="id" readonly />
					</div>
					<div class="form-outline mb-4 mt-4">
						<label for="form2Example1">Nombre</label>
						<input value="<?php echo $hotelSingle->room_name; ?>" type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<label for="form2Example1">Precio</label>
						<input value="<?php echo $hotelSingle->price; ?>" type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<label for="form2Example1">Numero de personas</label>
						<input value="<?php echo $hotelSingle->num_persons; ?>" type="text" name="num_persons" id="form2Example1" class="form-control" placeholder="num_persons" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<label for="form2Example1">Numero de camas</label>
						<input value="<?php echo $hotelSingle->num_beds; ?>" type="text" name="num_beds" id="form2Example1" class="form-control" placeholder="num_beds" />
					</div>
					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>
				</form>
			</div>
		</div>
	</div>
</div>


<?php require_once('../../layouts/footer.php'); ?>