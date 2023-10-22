<?php

require '../includes/header.php';

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
			window.location='" . APPURL . "';
			}
		});
	</script>";
