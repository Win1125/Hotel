<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>

<?php

$validar = $_SESSION['username'];

if (!isset($validar)) {
	echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}

$rooms = $conn->query("SELECT r.*, h.name AS hotel_name, s.name AS status_name FROM rooms r
						JOIN hotels h ON r.id_hotel = h.id_hotel
						JOIN status s ON r.id_status = s.id_status;");
$rooms->execute();

$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Rooms</h5>
				<a href="create-rooms.php" class="btn btn-primary mb-4 text-center float-right">Create Room</a>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Price</th>
							<th scope="col">Capacity</th>
							<th scope="col">Size</th>
							<th scope="col">View</th>
							<th scope="col">Beds</th>
							<th scope="col">Hotel name</th>
							<th scope="col">Status</th>
							<th scope="col">Change status</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allRooms as $room) : ?>
							<tr>
								<th scope="row"><?php echo $room->id_room ?></th>
								<td><?php echo $room->room_name ?></td>
								<td>$ <?php echo $room->price ?></td>
								<td><?php echo $room->num_persons ?></td>
								<td><?php echo $room->size ?></td>
								<td><?php echo $room->view ?></td>
								<td><?php echo $room->num_beds ?></td>
								<td><?php echo $room->hotel_name ?></td>
								<td><?php echo $room->status_name ?></td>
								<td><a href="status-rooms.php?id=<?php echo $room->id_room ?>" class="btn btn-success  text-center ">status</a></td>
								<td>
									<a href="update-rooms.php?id=<?php echo $room->id_room ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
									<a href="" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php require_once('../../layouts/footer.php'); ?>