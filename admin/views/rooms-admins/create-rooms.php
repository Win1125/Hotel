<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>


<?php
if (!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}


$hotels = $conn->query("SELECT * FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);


if (isset($_POST['submit'])) {

	if (empty($_POST['name']) || empty($_POST['price'])|| empty($_POST['num_persons'])|| empty($_POST['num_beds']) || 
		empty($_POST['size']) || empty($_POST['view']) || empty($_POST['hotel_name']) || empty($_POST['id_hotel'])) 
	{
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

		$dir = "roomImages/" . basename($image);

		$price = $_POST['price'];
		$num_persons = $_POST['num_persons'];
		$num_beds = $_POST['num_beds'];
		$size = $_POST['size'];
		$view = $_POST['view'];
		$hotel_name = $_POST['hotel_name'];
		$id_hotel = $_POST['id_hotel'];

		$insert = $conn->prepare("INSERT INTO rooms (room_name, image, price, num_persons, num_beds, size, view, id_hotel, hotel_name) 
											  VALUES (:room_name,:image,:price,:num_persons,:num_beds,:size,:view,:id_hotel,:hotel_name)");

		$insert->execute([
			":room_name" => $name,
			":image" => $image,
			":price" => $price,
			":num_persons" => $num_persons,
			":num_beds" => $num_beds,
			":size" => $size,
			":view" => $view,
			":id_hotel" => $id_hotel,
			":hotel_name" => $hotel_name
		]);

		if ($insert && move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
			echo	"<script>
						Swal.fire({
							icon : 'success',
							title: 'Registro Exitoso',
							text: 'Habitación registrada',
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

?>


<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Create Rooms</h5>
				<form method="POST" action="create-rooms.php" enctype="multipart/form-data">
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<input type="file" name="image" id="form2Example1" class="form-control" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="num_persons" id="form2Example1" class="form-control" placeholder="num_persons" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="num_beds" id="form2Example1" class="form-control" placeholder="num_beds" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="size" id="form2Example1" class="form-control" placeholder="size" />
					</div>
					<div class="form-outline mb-4 mt-4">
						<input type="text" name="view" id="form2Example1" class="form-control" placeholder="view" />
					</div>

					<select name="hotel_name" class="form-control">
						<option>Choose Hotel Name</option>
						<?php foreach ($allHotels as $hotel): ?>
							<option value="<?php echo $hotel -> name; ?>"><?php echo $hotel -> name; ?></option>
						<?php endforeach; ?>
					</select>
					<br>

					<select name="id_hotel" class="form-control">
						<option>Choose Same Hotel Once Again</option>
						<?php foreach ($allHotels as $hotel):  ?>
							<option value="<?php echo $hotel -> $id_hotel; ?>"><?php echo $hotel -> name; ?></option>
						<?php endforeach; ?>
					</select>
					<br>

					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../../layouts/footer.php'); ?>