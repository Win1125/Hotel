<?php require_once ('../layouts/header.php'); ?>
<?php require_once ('../../config/config.php'); ?>

<?php

if(!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href= '".ADMINURL."admins/login-admins.php' </script>";
}

	$bookings = $conn->query("SELECT * FROM booking");
	$bookings->execute();

	$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Bookings</h5>

				<table class="table">
					<thead>
						<tr>
							<th scope="col">Check in</th>
							<th scope="col">Check out</th>
							<th scope="col">Email</th>
							<th scope="col">Phone</th>
							<th scope="col">Name</th>
							<th scope="col">Hotel</th>
							<th scope="col">Room</th>
							<th scope="col">Status</th>
							<th scope="col">Payment</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allBookings as $book): ?>
							<tr>
								<td><?php echo $book -> check_in; ?></td>
								<td><?php echo $book -> check_out; ?></td>
								<td><?php echo $book -> email; ?></td>
								<td><?php echo $book -> phone_number; ?></td>
								<td><?php echo $book -> full_name; ?></td>
								<td><?php echo $book -> hotel_name; ?></td>
								<td><?php echo $book -> room_name; ?></td>

								<td><?php if($book -> status == "Finished"){?> 
										<a class="btn btn-small btn-success" aria-disabled="true"><?php echo $book -> status; ?> <i class="fa-solid fa-rotate-right"></i></a>
									<?php }else{?>
										<a href="status-bookings.php?id=<?php echo $book -> id_booking; ?>" class="btn btn-small btn-success"><?php echo $book -> status; ?> <i class="fa-solid fa-rotate-right"></i></a>
									<?php } ?>
								</td>

								<td><?php echo $book -> payment; ?></td>

								<td><a href="update-bookings.php?id=<?php echo $book -> id_booking; ?>" class="btn btn-small btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i></a></td>	
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

