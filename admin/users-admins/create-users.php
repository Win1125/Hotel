<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

if (!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}


if (isset($_POST['submit'])) {

	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

		echo "<script type='text/javascript'>
				Swal.fire({
					icon : 'error',
					title: 'Ocurrió un error inesperado',
					text: 'No has llenado todos los campos que son requeridos',
					type: 'error',
					confirmButtonText: 'Aceptar'
				});
          	</script>";
	} else {

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$insert = $conn->prepare("INSERT INTO user (username, email, mypassword) VALUES (:username, :email, :mypassword)");

			$insert->execute([
				":username" => $username,
				":email" => $email,
				":mypassword" => $password
			]);

			if ($insert) {
				echo	"<script>
						Swal.fire({
							icon : 'success',
							title: 'Registro Exitoso',
							text: 'Usuario registrado',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='admins.php';
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
	}
}

?>


<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Create Users</h5>
				<form method="POST" action="create-users.php" enctype="multipart/form-data">
					<!-- Email input -->
					<div class="form-outline mb-4 mt-4">
						<input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
					</div>

					<div class="form-outline mb-4">
						<input type="text" name="username" id="form2Example1" class="form-control" placeholder="user name" />
					</div>
					<div class="form-outline mb-4">
						<input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
					</div>

					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
require_once('../layouts/footer.php');
?>