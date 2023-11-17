<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>


<?php

$validar = $_SESSION['username'];

if (!isset($validar)) {
    echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}


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
		$image = $_FILES['image']['name'];

		$dir = "hotelImages/" . basename($image);

		$description = $_POST['description'];
		$location = $_POST['location'];

		$insert = $conn->prepare("INSERT INTO hotels (name, image, description, location) VALUES (:name, :image, :description, :location)");

		$insert->execute([
			":name" => $name,
			":image" => $image,
			":description" => $description,
			":location" => $location
		]);

		if ($insert && move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
			echo	"<script>
						Swal.fire({
							icon : 'success',
							title: 'Registro Exitoso',
							text: 'Hotel registrado',
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
				<h5 class="card-title mb-5 d-inline">Create Hotels</h5>
				<form method="POST" action="create-hotels.php" enctype="multipart/form-data" autocomplete="off">
					<!-- Email input -->
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
					</div>

					<div class="form-outline mb-4 mt-4">
						<input type="file" name="image" id="form2Example1" class="form-control" />
					</div>

					<div class="form-group">
						<label for="exampleFormControlTextarea1">Description</label>
						<textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>

					<div class="form-outline mb-4 mt-4">
						<label for="exampleFormControlTextarea1">Location</label>
						<input type="text" name="location" id="form2Example1" class="form-control" />
					</div>

					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../../layouts/footer.php'); ?>