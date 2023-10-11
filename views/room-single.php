<?php

require_once('../includes/header.php');
require_once('../config/config.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
	$room = $conn->query("SELECT * FROM rooms WHERE id_room ='$id' AND status = 1");
	$room->execute();

	$singleRoom = $room->fetch(PDO::FETCH_OBJ);


	//Grapping the utilities
	$utilities = $conn->query("SELECT * FROM utilities WHERE id_room = '$id'");
	$utilities->execute();

	$allUtilities = $utilities->fetchAll(PDO::FETCH_OBJ);
}

?>

<div class="hero-wrap js-fullheight" style="background-image: url('../resources/images/<?php echo $singleRoom->image; ?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<h2 class="subheading">Welcome to Vacation Rental</h2>
				<h1 class="mb-4"><?php echo $singleRoom->name; ?></h1>
				<!-- <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
			</div>
		</div>
	</div>
</div>



<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-lg-4">
				<form action="#" class="appointment-form" style="margin-top: -568px;">
					<h3 class="mb-3">Book this room</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Email">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Full Name">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Phone Number">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
									<input type="text" class="form-control appointment_date-check-in" placeholder="Check-In">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="icon"><span class="ion-md-calendar"></span></div>
								<input type="text" class="form-control appointment_date-check-out" placeholder="Check-Out">
							</div>
						</div>



						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="Book and Pay Now" class="btn btn-primary py-3 px-4">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>



<section class="ftco-section bg-light">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-6 wrap-about">
				<div class="img img-2 mb-4" style="background-image: url(../resources/images/image_2.jpg);">
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
						<?php foreach($allUtilities as $utility) : ?>
							<div class="services-2 col-lg-6 d-flex w-100">
								<div class="icon d-flex justify-content-center align-items-center">
									<span class="<?php echo $utility->icon; ?>"></span>
								</div>
								<div class="media-body pl-3">
									<h3 class="heading"><?php echo $utility->name; ?></h3>
									<p><?php echo $utility->description; ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php

require_once('../includes/section.php');
require_once('../includes/footer.php');

?>