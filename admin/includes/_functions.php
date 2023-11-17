<?php

require_once("_db.php");
require_once('../layouts/header.php');
require_once('../../config/config.php');



if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'acceso_user';
            acceso_user();
            break;
    }
}



function acceso_user()
{
    $validar = $_SESSION['username'];

    if (!isset($validar)) {
        echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
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

            $email = $_POST['email'];
            $password = $_POST['password'];

            //Validate the email with query
            $conexion = mysqli_connect("localhost", "root", "", "hotel_a");

            $consulta = "SELECT u.id_user, u.username, u.email, u.mypassword, r.role_name as rol FROM users u
                        JOIN user_roles ur ON u.id_user = ur.id_user
                        JOIN roles r ON ur.id_role = r.id_role
                        WHERE u.email = '$email'
                        AND (r.role_name = 'Administrador' OR r.role_name = 'Recepcionista');";

            $resultado = mysqli_query($conexion, $consulta);
            $filas = mysqli_fetch_assoc($resultado);

            //get the row count
            if ($filas > 0) {

                if (password_verify($password, $filas['mypassword'])) {

                    echo "<script>
						Swal.fire({
							icon : 'success',
							title: 'Bienvenido '.$validar.'',
							text: 'Nos encanta recibirte',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='" . ADMINURL . "';
						   	}
					    });
					</script>";

                    $_SESSION['username'] = $filas['username'];
                    $_SESSION['id_user'] = $filas['id_user'];
                    $_SESSION['rol'] = $filas['rol'];
                } else {
                    echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Ocurrió un error inesperado',
								text: 'El Usuario o Clave son incorrectos',
								type: 'error',
								confirmButtonText: 'Aceptar'
							}).then((result) => {
                                if(result.isConfirmed){
                                    window.location='" . ADMINURL . "';
                                   }
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
					}).then((result) => {
                        if(result.isConfirmed){
                            window.location='" . ADMINURL . "';
                           }
                    });
				</script>";
            }
        }
    }
}
