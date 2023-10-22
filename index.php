<?php

include_once('./includes/header.php');
require_once './config/config.php';

//Consultas de Hoteles
$hotels = $conn->query("SELECT * FROM hotels WHERE status = 1");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);



//Consultas de Habitaciones
$rooms = $conn->query("SELECT * FROM rooms WHERE status = 1");
$rooms->execute();

$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);

?>

<div class="hero-wrap js-fullheight" style="background-image: url(./resources/images/image_2.jpg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<h2 class="subheading">Welcome to Vacation Rental</h2>
				<h1 class="mb-4">Rent an appartment for your vacation</h1>
				<p><a href="<?php echo APPURL; ?>views/about.php" class="btn btn-primary">Learn more</a> <a href="<?php echo APPURL; ?>views/contact.php" class="btn btn-white">Contact us</a></p>
			</div>
		</div>
	</div>
</div>


<section class="ftco-section ftco-services">
	<div class="container">
		<div class="row">
			<?php foreach($allHotels as $hotel) : ?>
				<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
					<div class="d-block services-wrap text-center">
						<div class="img" style="background-image: url(<?php echo HOTELIMAGES ?>/<?php echo $hotel->image; ?>);"></div>
						<div class="media-body py-4 px-3">
							<h3 class="heading"><?php echo $hotel->name; ?></h3>
							<p><?php echo $hotel->description; ?></p>
							<p>Location: <?php echo $hotel->location; ?></p>
							<p><a href="./views/rooms.php?id=<?php echo $hotel->id_hotel; ?>" class="btn btn-primary">View rooms</a></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container-fluid px-md-0">
		<div class="row no-gutters justify-content-center pb-5 mb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>Apartment Room</h2>
			</div>
		</div>
		<div class="row no-gutters">
			<?php foreach ($allRooms as $room): ?>
				<div class="col-lg-6">
					<div class="room-wrap d-md-flex">
						<a href="./views/room-single.php?id=<?php echo $room->id_room; ?>" class="img" style="background-image: url(<?php echo ROOMSIMAGES; ?>/<?php echo $room->image; ?>);"></a>
						<div class="half left-arrow d-flex align-items-center">
							<div class="text p-4 p-xl-5 text-center">
								<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
								<p class="mb-0"><span class="price mr-1">$<?php echo $room->price; ?></span> <span class="per">per night</span></p>
								<h3 class="mb-3"><a href="./views/room-single.php?id=<?php echo $room->id_room; ?>"><?php echo $room->room_name; ?></a></h3>
								<ul class="list-accomodation">
									<li><span>Max:</span> <?php echo $room->num_persons; ?> Persons</li>
									<li><span>Size:</span> <?php echo $room->size; ?> m2</li>
									<li><span>View:</span> <?php echo $room->view; ?></li>
									<li><span>Bed:</span> <?php echo $room->num_beds; ?></li>
								</ul>
								<p class="pt-1"><a href="./views/room-single.php?id=<?php echo $room->id_room; ?>" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>



<section class="ftco-section bg-light">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-6 wrap-about">
				<div class="img img-2 mb-4" style="background-image: url(./resources/images/image_2.jpg);">
				</div>
				<h2>The most recommended vacation rental</h2>
				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
			</div>
			<div class="col-md-6 wrap-about ftco-animate">
				<div class="heading-section">
					<div class="pl-md-5">
						<h2 class="mb-2">What we offer</h2>
					</div>
				</div>
				<div class="pl-md-5">
					<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
					<div class="row">
						<div class="services-2 col-lg-6 d-flex w-100">
							<div class="icon d-flex justify-content-center align-items-center">
								<span class="flaticon-diet"></span>
							</div>
							<div class="media-body pl-3">
								<h3 class="heading">Tea Coffee</h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<?php 

require_once './includes/section.php';
require_once './includes/footer.php';

?>