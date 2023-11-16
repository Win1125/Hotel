<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

$validar = $_SESSION['admin_name'];

if (!isset($validar)) {
	echo "<script>window.location.href='" . ADMINURL . "includes/login.php' </script>";
	die();
}


if (isset($_POST['registrar_usuario'])) {

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
								window.location='../views/users-admins/show-users.php';
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





if (isset($_POST['registrar_admin'])) {


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
								window.location='../views/admins/show-admins.php';
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

