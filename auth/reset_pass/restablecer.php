<?php 
    require_once ('../../config/config.php');
    require_once ('../../includes/header.php');

    $email =$_POST['email'];
    $bytes = random_bytes(50);
    $token =bin2hex($bytes);
    
    include "mail_reset.php";

    if($enviado){

        $insert = $conn->prepare("INSERT INTO passwords (email, token, codigo) VALUES (:email, :token, :codigo)");

		$insert->execute([
			":email" => $email,
			":token" => $token,
            ":codigo" => $codigo
		]);

        if($insert) {

            echo "<script>
                    Swal.fire({
                        icon : 'info',
                        title: 'Verifica tu email',
                        text: 'Hemos enviado un codigo a tu correo para poder reestablecer tu contraseña',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='" . APPURL . "/auth/login.php';
                           }
                    });
                </script>";
        }
    }
   

?>