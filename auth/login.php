<?php

require '../includes/header.php';

require_once '../config/config.php';

/*--------- Funcion verificar datos ---------*/
function verificar_datos($filtro, $cadena)
{
	if (preg_match("/^" . $filtro . "$/", $cadena)) {
		return false;
	} else {
		return true;
	}
}


if (isset($_SESSION['username'])) {
	echo "<script>window.location.href='" . APPURL . "' </script>";
}

if (isset($_POST['submit'])) {

	if (empty($_POST['password']) || empty($_POST['email'])) {

		echo "<script type='text/javascript'>
				Swal.fire({
					title: 'Ocurrió un error inesperado',
					text: 'No has llenado todos los campos que son requeridos',
					type: 'error',
					confirmButtonText: 'Aceptar'
				});
          	</script>";

	} else {

		$password = $_POST['password'];
		$email = $_POST['email'];

		//Validate the email with query

		$login = $conn->query("SELECT u.id_user, u.username, u.email, u.mypassword FROM users u 
							   JOIN user_roles ur ON u.id_user = ur.id_user 
							   JOIN roles r ON ur.id_role = r.id_role 
							   WHERE u.email = '$email' 
							   AND r.role_name = 'Cliente';");
		$login->execute();

		$fetch = $login->fetch(PDO::FETCH_ASSOC);

		//get the row count

		if ($login->rowCount() > 0) {

			if (password_verify($password, $fetch['mypassword'])) {

				echo "<script>
						Swal.fire({
							icon : 'success',
							title: 'Bienvenido',
							text: 'Nos encanta recibirte',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='" . APPURL . "';
						   	}
					    });
					</script>";

				$_SESSION['username'] = $fetch['username'];
				$_SESSION['id_user'] = $fetch['id_user'];

				
			} else {

				/*------------Verificamos la integridad de los datos-----------------*/
				if (verificar_datos("[a-zA-Z0-9]{1,35}", $email)) {

					echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Ocurrió un error inesperado',
								text: 'El Usuario es incorrecto, por favor verifica',
								type: 'error',
								confirmButtonText: 'Aceptar'
							});
						</script>";
				}

				if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $password)) {
					echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Ocurrió un error inesperado',
								text: 'La contraseña es incorrecta, por favor verifica',
								type: 'error',
								confirmButtonText: 'Aceptar'
							});
						</script>";
				}

				echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Ocurrió un error inesperado',
								text: 'El Usuario o Clave son incorrectos',
								type: 'error',
								confirmButtonText: 'Aceptar'
							});
						</script>";
			}
		} else {

			echo "<script type='text/javascript'>
					Swal.fire({
						title: 'Ocurrió un error inesperado',
						text: 'El Usuario no existe',
						type: 'error',
						confirmButtonText: 'Aceptar'
					});
				</script>";
		}
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
				<form action="login.php" method="post" class="appointment-form" style="margin-top: -568px;" autocomplete="off">
					<h3 class="mb-3">Login</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" pattern="[a-zA-Z0-9$@.-]{7,100}" class="form-control" name="email" placeholder="Email">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password">
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group">
								<a href="./restablecer.php">Forgot my password</a> <br>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="Login" name="submit" class="btn btn-primary py-3 px-4">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php require '../includes/footer.php' ?>