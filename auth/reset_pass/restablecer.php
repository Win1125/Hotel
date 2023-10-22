<?php 
    require_once ('../../config/config.php');

    $email =$_POST['email'];
    $bytes = random_bytes(20);
    $token =bin2hex($bytes);
    
    include "mail_reset.php";

    if($enviado){

        $insert = $conn->prepare("INSERT INTO passwords (email, token, codigo) VALUES (:email, :token, :codigo)");

		$insert->execute([
			":email" => $email,
			":token" => $token,
            ":codigo" => $codigo
		]);

        echo '<p>Verifica tu email para restablecer tu cuenta</p>';
    }
   

?>