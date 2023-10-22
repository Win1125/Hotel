<?php 
    include "./config/config.php";


    $email =$_POST['email'];
    $p1 =$_POST['p1'];
    $p2 =$_POST['p2'];

    if($p1 == $p2){
        
        $p1 = password_hash($p1, PASSWORD_DEFAULT);
        
		$update = $conn->prepare("UPDATE user SET mypassword = :mypassword WHERE email='$email'");

		$update->execute([
			":mypassword" => $p1
		]);

        echo "todo bien";
    }else{
        echo "no coinciden";
    }
?>