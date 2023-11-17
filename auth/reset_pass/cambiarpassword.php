<?php
include "../../config/config.php";
require_once ('../../includes/header.php');


$email = $_POST['email'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];

if ($p1 == $p2) {

    $p1 = password_hash($p1, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE users SET mypassword = :mypassword WHERE email='$email'");

    $update->execute([
        ":mypassword" => $p1
    ]);

    if ($update) {
        echo    "<script>
                    Swal.fire({
                        icon : 'success',
                        title: 'Contraseña cambiada',
                        text: 'Tu contraseña ha sido cambiada, por favor inicia sesión',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='" . APPURL . "/auth/login.php';
                           }
                    });
                </script>";
    }
} else {
    echo    "<script>
                Swal.fire({
                    icon : 'error',
                    title: 'Error Fatal',
                    text: 'Las contraseñas no coinciden por favor verifica e intente nuevamente',
                    type: 'success'
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location='" . APPURL . "/auth/login.php';
                       }
                });
            </script>";
}
