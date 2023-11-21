<?php

require_once '../includes/header.php';
require_once '../config/config.php';

if (isset($_SESSION['username'])) {
	echo "<script>window.location.href='" . APPURL . "' </script>";
}

if (isset($_POST['submit'])) {

	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

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
		$email_tabla = '';

		//Validate the email
		$login = $conn->query("SELECT u.id_user, u.username, u.email, u.mypassword FROM users u 
								JOIN user_roles ur ON u.id_user = ur.id_user 
								JOIN roles r ON ur.id_role = r.id_role 
								WHERE u.email = '$email'");
		$login->execute();

		$fetch = $login->fetch(PDO::FETCH_ASSOC);

		$username = $_POST['username'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$email = $_POST['email'];

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$insert = $conn->prepare("CALL InsertUserWithRole(:username, :email, :password, 'Cliente')");

			$insert->execute([
				":username" => $username,
				":email" => $email,
				":password" => $password
			]);

			if ($insert) {
				echo	"<script>
						Swal.fire({
							icon : 'success',
							title: 'Registro Exitoso',
							text: 'Cliente registrado',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='./login.php';
							}
						});
					</script>";
			}
		} else {
			echo "<script>
						Swal.fire({
							icon : 'warning',
							title: 'Ups!',
							text: 'Ingresa un correo valido',
							type: 'error'
						});
					</script>";
		}
		//}
	}
}

?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>images/image_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<!-- <h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4">Rent an appartment for your vacation</h1>
            <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row justify-content-middle" style="margin-left: 397px;">
			<div class="col-md-6 mt-5">
				<form action="register.php" method="post" class="appointment-form" style="margin-top: -568px;">
					<h3 class="mb-3">Register</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username" value="<?php if (isset($username)) echo $username ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" pattern="[a-zA-Z0-9$@.-]{7,100}" class="form-control" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password">
							</div>
						</div>



						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="submit" value="Register" class="btn btn-primary py-3 px-4">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<?php

require_once '../includes/footer.php';

?>