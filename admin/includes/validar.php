<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

$validar = $_SESSION['username'];

if (!isset($validar)) {
	echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
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

			$insert = $conn->prepare("CALL InsertUserWithRole(:username, :email, :mypassword, 'Cliente')");

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


	if (empty($_POST['admin_name']) || empty($_POST['password']) || empty($_POST['email'])
	 || empty($_POST['password2']) || empty($_POST['rol_name'])) {

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
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$rol = $_POST['rol_name'];

		if($password != $password2){
			echo "<script type='text/javascript'>
				Swal.fire({
					icon : 'error',
					title: 'Ups! Ocurrió un error inesperado',
					text: 'Las contraseñas no son iguales',
					type: 'error',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if(result.isConfirmed){
						window.location='../views/admins/show-admins.php';
					}
				});
          	</script>";
		}else{

			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$insert = $conn->prepare("CALL InsertUserWithRole(:username, :email, :mypassword, :rol)");
	
				$insert->execute([
					":username" => $admin_name,
					":email" => $email,
					":mypassword" => $password,
					":rol" => $rol
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
}

?>

