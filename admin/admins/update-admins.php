<?php require_once ('../layouts/header.php'); ?>
<?php require_once ('../../config/config.php'); ?>

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




<?php require_once ('../layouts/footer.php'); ?>