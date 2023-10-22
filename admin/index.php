<?php require_once ('layouts/header.php') ?>
<?php require_once ('../config/config.php') ?>

<?php
if(!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href='".ADMINURL."admins/login-admins.php' </script>";
}


$hotels = $conn->query("SELECT COUNT(*) AS count_hotels FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetch(PDO::FETCH_OBJ);


$rooms = $conn->query("SELECT COUNT(*) AS count_rooms FROM rooms");
$rooms->execute();

$allRooms = $rooms->fetch(PDO::FETCH_OBJ);


$users = $conn->query("SELECT COUNT(*) AS count_users FROM user");
$users->execute();

$allUsers = $users->fetch(PDO::FETCH_OBJ);


$bookings = $conn->query("SELECT COUNT(*) AS count_books FROM booking");
$bookings->execute();

$allBookings = $bookings->fetch(PDO::FETCH_OBJ);
?>


<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Hotels</h5>
				<p class="card-text">number of hotels: <?php echo $allHotels->count_hotels ?></p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Rooms</h5>
				<p class="card-text">number of rooms: <?php echo $allRooms->count_rooms ?></p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Users</h5>
				<p class="card-text">number of users: <?php echo $allUsers->count_users ?></p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Bookings</h5>
				<p class="card-text">number of hotels: <?php echo $allBookings->count_books ?></p>
			</div>
		</div>
	</div>
</div>


<?php require_once ('layouts/footer.php') ?>