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

	if (isset($_POST['submit'])) {

		if (empty($_POST['full_name']) || empty($_POST['phone_number']) || empty($_POST['email']) || 
			empty($_POST['check_in']) || empty($_POST['check_out'])) {
	
			echo "<script type='text/javascript'>
					Swal.fire({
						title: 'Ocurrió un error inesperado',
						text: 'No has llenado todos los campos que son requeridos',
						type: 'error',
						confirmButtonText: 'Aceptar'
					});
				  </script>";
		} else {
	
			$email = $_POST['email'];
			$full_name = $_POST['full_name'];
			$phone_number = $_POST['phone_number'];
			$check_in = $_POST['check_in'];
			$check_out = $_POST['check_out'];
			$hotel_name = $singleRoom->hotel_name;
			$room_name = $singleRoom->room_name;
			$id_user = $_SESSION['id_user'];

			if(date("Y/m/d") > $check_in OR date("Y/m/d") > $check_out){
				echo "<script type='text/javascript'>
						Swal.fire({
							title: 'Ocurrió un error inesperado',
							text: 'No puedes seleccionar una fecha del pasado, selecciona una apartir de mañana',
							type: 'error',
							confirmButtonText: 'Aceptar'
						});
					</script>";
			}else{
				if($check_in > $check_out OR $check_in == date("Y/m/d")){
					echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Ocurrió un error inesperado',
								text: 'Elija una fecha que no sea hoy para el check in y elija una fecha de check in menor que la fecha de check out',
								type: 'error',
								confirmButtonText: 'Aceptar'
							});
						</script>";
				}else{
					$booking = $conn -> prepare("INSERT INTO bookings (email, full_name, phone_number, check_in, check_out, hotel_name, room_name, id_user) 
												 VALUES (:email, :full_name, :phone_number, :check_in, :check_out, :hotel_name, :room_name, :id_user");

					$booking -> execute([
						":email" => $email,
						":full_name" => $full_name,
						":phone_number" => $phone_number,
						":check_in" => $check_in,
						":check_out" => $check_out,
						":hotel_name" => $hotel_name,
						":room_name" => $room_name,
						":id_user" => $id_user
					]);
				}
			}
		}
	}
}

?>

<div class="hero-wrap js-fullheight" style="background-image: url(../resources/images/<?php echo $singleRoom->image; ?>);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<h2 class="subheading">Welcome to Vacation Rental</h2>
				<h1 class="mb-4"><?php echo $singleRoom->room_name; ?></h1>
				<!-- <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
			</div>
		</div>
	</div>
</div>



<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-lg-4">
				<form action="room-single.php?id=<?php echo $id; ?>" method="post" class="appointment-form" style="margin-top: -568px;">
					<h3 class="mb-3">Book this room</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="email" class="form-control" placeholder="Email">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="full_name" class="form-control" placeholder="Full Name">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
									<input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="icon"><span class="ion-md-calendar"></span></div>
								<input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out">
							</div>
						</div>

						<?php if(!isset($_SESSION['username']) OR !isset($_SESSION['id_user'])) : ?>
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">No has iniciado sesión!</h5>
									<p class="card-text">Si deseas reservar una habitación debes iniciar sesión!</p>
									<a href="<?php echo APPURL; ?>auth/login.php" class="btn btn-primary py-3 px-4">Iniciar Sesión</a>
								</div>
							</div>
							
							<!--<div class="col-md-12">
								<div class="form-group">
									<button type="button" class="btn btn-primary py-3 px-4" data-bs-toggle="popover" data-bs-placement="top" data-bs-custom-class="custom-popover" data-bs-title="No has iniciado Sesión" data-bs-content="Si deseas reservar una habitación debes iniciar sesión!">
										Book and Pay Now
									</button>
								</div>
							</div>-->
						<?php else : ?>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" name="submit" value="Book and Pay Now" class="btn btn-primary py-3 px-4">
								</div>
							</div>
						<?php endif; ?>
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