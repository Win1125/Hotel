<?php
require_once ('../../layouts/header.php'); 

try {
	session_unset();
	session_destroy();

	echo "<script>
			Swal.fire({
				icon : 'success',
				title: 'Adiós',
				text: 'Esperamos haberte ayudado!',
				type: 'success'
			}).then((result) => {
				if(result.isConfirmed){
				window.location='" . ADMINURL . "includes/login.php';
				}
			});
		</script>";
} catch (\Throwable $th) {
	//throw $th;
}

?>