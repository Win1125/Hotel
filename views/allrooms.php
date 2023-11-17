<?php

require_once('../includes/header.php');
require_once('../config/config.php');

$rooms = $conn->query("SELECT DISTINCT * FROM rooms WHERE id_status = 1");
$rooms->execute();

$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);

?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('../resources/images/image_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span> <span>Rooms <i class="fa fa-chevron-right"></i></span></p>
				<h1 class="mb-0 bread">Apartment Room</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
	<div class="container-fluid px-md-0">
		<div class="row no-gutters">

			<?php foreach ($allRooms as $room) : ?>
				<div class="col-lg-6">
					<div class="room-wrap d-md-flex">
						<a class="img" style="background-image: url(<?php echo ROOMSIMAGES; ?>/<?php echo $room->image; ?>);"></a>
						<div class="half left-arrow d-flex align-items-center">
							<div class="text p-4 p-xl-5 text-center">
								<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
								<p class="mb-0"><span class="price mr-1">$<?php echo $room->price; ?></span> <span class="per">per night</span></p>
								<h3 class="mb-3"><?php echo $room->room_name; ?></h3>
								<ul class="list-accomodation">
									<li><span>Max:</span> <?php echo $room->num_persons; ?> Persons</li>
									<li><span>Size:</span> <?php echo $room->size; ?> m2</li>
									<li><span>View:</span> <?php echo $room->view; ?></li>
									<li><span>Bed:</span> <?php echo $room->num_beds; ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<div class="col-lg-6">
				<div class="room-wrap d-md-flex">
					<a class="img" style="background-image: url(../resources/images/room-5.jpg);"></a>
					<div class="half left-arrow d-flex align-items-center">
						<div class="text p-4 p-xl-5 text-center">
							<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
							<h3 class="mb-3"><a href="rooms.html">Luxury Room</a></h3>
							<ul class="list-accomodation">
								<li><span>Max:</span> 3 Persons</li>
								<li><span>Size:</span> 45 m2</li>
								<li><span>View:</span> Sea View</li>
								<li><span>Bed:</span> 1</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="room-wrap d-md-flex">
					<a class="img" style="background-image: url(../resources/images/room-6.jpg);"></a>
					<div class="half left-arrow d-flex align-items-center">
						<div class="text p-4 p-xl-5 text-center">
							<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
							<h3 class="mb-3"><a href="rooms.html">Superior Room</a></h3>
							<ul class="list-accomodation">
								<li><span>Max:</span> 3 Persons</li>
								<li><span>Size:</span> 45 m2</li>
								<li><span>View:</span> Sea View</li>
								<li><span>Bed:</span> 1</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php

require_once('../includes/footer.php');

?>