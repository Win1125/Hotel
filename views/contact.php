<?php

require_once('../includes/header.php');
require_once('../config/config.php');

?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('../resources/images/image_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact <i class="fa fa-chevron-right"></i></span></p>
				<h1 class="mb-0 bread">Contact Us</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-8">
				<div id="map" class="map"></div>
			</div>
			<div class="col-md-4 p-4 p-md-5 bg-white">
				<h2 class="font-weight-bold mb-4">Lets get started</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
				<p><a href="<?php echo APPURL; ?>" class="btn btn-primary">Book Apartment Now</a></p>
			</div>
			<div class="col-md-12">
				<div class="wrapper">
					<div class="row no-gutters">
						<div class="col-lg-8 col-md-7 d-flex align-items-stretch">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4">Get in touch</h3>
								<!--<div id="form-message-warning" class="mb-4"></div>
								<div id="form-message-success" class="mb-4">
									Your message was sent, thank you!
								</div>-->
								<form method="POST" id="contactForm" name="contactForm" class="contactForm">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="name">Full Name</label>
												<input type="text" class="form-control" name="name" id="name" placeholder="Name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="email">Email Address</label>
												<input type="email" class="form-control" pattern="[a-zA-Z0-9$@.-]{7,100}" name="email" id="email" placeholder="Email">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="subject">Subject</label>
												<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="#">Message</label>
												<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" name="send" value="Send Message" class="btn btn-primary">
												<div class="submitting"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
							<div class="info-wrap bg-primary w-100 p-md-5 p-4">
								<h3>Let's get in touch</h3>
								<p class="mb-4">We're open for any suggestion or just to have a chat</p>
								<div class="dbox w-100 d-flex align-items-start">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="text pl-3">
										<p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-phone"></span>
									</div>
									<div class="text pl-3">
										<p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-paper-plane"></span>
									</div>
									<div class="text pl-3">
										<p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-globe"></span>
									</div>
									<div class="text pl-3">
										<p><span>Website</span> <a href="#">yoursite.com</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php

if (isset($_POST['send'])) {

	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {

		echo "<script type='text/javascript'>
				Swal.fire({
					title: 'Ocurrió un error inesperado',
					text: 'No has llenado todos los campos que son requeridos',
					type: 'error',
					confirmButtonText: 'Aceptar'
				});
          	</script>";
	} else {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		//Validate the email with query

		$contact = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)");

		$contact->execute([
			":name" => $name,
			":email" => $email,
			":subject" => $subject,
			":message" => $message
		]);

		if ($contact) {
			echo	"<script>
						Swal.fire({
							icon : 'success',
							title: 'Contacto Exitoso',
							text: 'El mensaje ha sido enviado correctamente',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='../index.php';
							}
						});
					</script>";
		}else{
			echo	"<script>
						Swal.fire({
							icon : 'error',
							title: 'Ups! Ocurrio un error inesperado',
							text: 'El mensaje no ha sido enviado correctamente, intenta nuevamente',
							type: 'error'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='../index.php';
							}
						});
					</script>";
		}
	}
}


require_once('../includes/footer.php');
?>