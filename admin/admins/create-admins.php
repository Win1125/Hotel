<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

if (!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}


if (isset($_POST['submit'])) {

	if (empty($_POST['admin_name']) || empty($_POST['password']) || empty($_POST['email'])) {

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

		$admin_name = $_POST['admin_name'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$insert = $conn->prepare("INSERT INTO admins (admin_name, email, mypassword) VALUES (:admin_name, :email, :mypassword)");

			$insert->execute([
				":admin_name" => $admin_name,
				":email" => $email,
				":mypassword" => $password
			]);

			if ($insert) {
				echo	"<script>
						Swal.fire({
							icon : 'success',
							title: 'Registro Exitoso',
							text: 'Administrador registrado',
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
				<h5 class="card-title mb-5 d-inline">Create Admins</h5>
				<form method="POST" action="create-admins.php" enctype="multipart/form-data">
					<!-- Email input -->
					<div class="form-outline mb-4 mt-4">
						<input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
					</div>

					<div class="form-outline mb-4">
						<input type="text" name="admin_name" id="form2Example1" class="form-control" placeholder="admin name" />
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