<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>

<?php

$validar = $_SESSION['username'];

if (!isset($validar)) {
	echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}

$hotels = $conn->query("SELECT h.*, s.name AS status_name FROM hotels h JOIN status s ON h.id_status = s.id_status;");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Hotels</h5>
				<a href="create-hotels.php" class="btn btn-primary mb-4 text-center float-right">Create Hotels</a>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Location</th>
							<th scope="col">Status value</th>
							<th scope="col">Created at</th>
							<th scope="col">Change status</th>
							<th scope="col">Update</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allHotels as $hotel) : ?>
							<tr>
								<th scope="row"><?php echo $hotel->id_hotel; ?></th>
								<td><?php echo $hotel->name; ?></td>
								<td><?php echo $hotel->location; ?></td>
								<td><?php echo $hotel->status_name; ?></td>
								<td><?php echo $hotel->created_at; ?></td>

								<td><a href="status-hotels.php?id=<?php echo $hotel->id_hotel; ?>" class="btn btn-success text-white text-center ">status</a></td>
								<td><a href="update-hotels.php?id=<?php echo $hotel->id_hotel; ?>" class="btn btn-warning text-white text-center "><i class="fa-solid fa-pen-to-square"></i></a></td>
								<td><a href="" class="btn btn-danger  text-center "><i class="fa-solid fa-trash"></i></a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



<?php require_once('../../layouts/footer.php'); ?>