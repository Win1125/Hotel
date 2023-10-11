<?php

require '../includes/header.php';

session_start();
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
			window.location='http://localhost/hotel-booking/';
			}
		});
	</script>";
