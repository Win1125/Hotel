<?php require_once ('../layouts/header.php'); ?>
<?php require_once ('../../config/config.php'); ?>
<?php

if (isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href='" . ADMINURL . "' </script>";
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
		$login = $conn->query("SELECT * FROM admins WHERE email = '$email'");
		$login->execute();

		$fetch = $login->fetch(PDO::FETCH_ASSOC);

		//get the row count
		if ($login->rowCount() > 0) {

			if (password_verify($password, $fetch['mypassword'])) {

				echo "<script>
						Swal.fire({
							icon : 'success',
							title: 'Bienvenido Administrador',
							text: 'Nos encanta recibirte',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='" . ADMINURL . "';
						   	}
					    });
					</script>";		
					
				$_SESSION['admin_name'] = $fetch['admin_name'];
				$_SESSION['id'] = $fetch['id'];
					
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

<div class="row">
	<div class="col">
		<div class="card mt-3">
			<div class="card-body">
				<h5 class="card-title mt-5">Login</h5>
				<form method="POST" class="p-auto" action="./login-admins.php" autocomplete="off">
					<!-- Email input -->
					<div class="form-outline mb-4">
						<input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" autocomplete="off" pattern="[a-zA-Z0-9$@.-]{7,100}"/>
					</div>

					<!-- Password input -->
					<div class="form-outline mb-4">
						<input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" autocomplete="off" />
					</div>

					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

<?php require_once ('../layouts/footer.php') ?>