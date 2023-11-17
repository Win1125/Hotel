<?php
include "../../config/config.php";
include "../../includes/header.php";

$email = $_POST['email'];
$token = $_POST['token'];
$codigo = $_POST['codigo'];

$res = $conn->query("SELECT * FROM passwords WHERE email='$email' AND token='$token' AND codigo=$codigo");
$res->execute();

//Verificar si el correo existe en la base de datos
$login = $conn->query("SELECT u.id_user, u.username, u.email, u.mypassword FROM users u 
                        JOIN user_roles ur ON u.id_user = ur.id_user 
                        JOIN roles r ON ur.id_role = r.id_role 
                        WHERE u.email = '$email'");

$login->execute();

if ($login->rowCount() > 0) {

    $correcto = false;
    if ($res->rowCount() > 0) {

        $fila = $res->fetch(PDO::FETCH_ASSOC);

        $fecha = $fila['created_at'];
        $fecha_actual = date("Y-m-d h:m:s");
        $seconds = strtotime($fecha_actual) - strtotime($fecha);
        $minutos = $seconds / 60;

        $correcto = true;
    } else {
        $correcto = false;
    }
} else {
    echo "<script>
            Swal.fire({
                icon : 'error',
                title: 'Ups! Ha ocurrido un error',
                text: 'El correo que ingresaste no existe :C',
                type: 'success'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='" . APPURL . "/auth/login.php';
                }
            });
        </script>";
}

?>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row justify-content-md-center m-5 mb-5">
            <?php if ($correcto) { ?>
                <form class="col-3" action="cambiarpassword.php" method="POST">
                    <h2>Restablecer Password</h2>
                    <div class="mb-3">
                        <label for="c" class="form-label">Nuevo Password</label>
                        <input type="password" class="form-control" id="c" name="p1">
                    </div>
                    <div class="mb-3">
                        <label for="c" class="form-label">Confirmar Password</label>
                        <input type="password" class="form-control" id="c" name="p2">
                        <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Cambiar</button>
                </form>
            <?php } else {
                echo "<script>
                        Swal.fire({
                            icon : 'error',
                            title: 'Ups! Ha ocurrido un error',
                            text: 'Codigo ingresado incorrecto, por favor intenta el proceso otra vez',
                            type: 'success'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location='" . APPURL . "/auth/login.php';
                            }
                        });
                    </script>";
            } ?>

        </div>
    </div>
</section>

<?php include "../../includes/footer.php"; ?>