<?php
include "../../config/config.php";
include "../../includes/header.php";

$email = $_POST['email'];
$token = $_POST['token'];
$codigo = $_POST['codigo'];

$res = $conn->query("SELECT * FROM passwords WHERE email='$email' AND token='$token' AND codigo=$codigo");
$res->execute();

$correcto = false;
if ($res->rowCount() > 0) {

    $fila = $res->fetch(PDO::FETCH_ASSOC);

    $fecha = $fila['created_at'];
    $fecha_actual = date("Y-m-d h:m:s");
    $seconds = strtotime($fecha_actual) - strtotime($fecha);
    $minutos = $seconds / 60;

    /* if($minutos > 10 ){
            echo "token vencido";
        }else{
            echo "todo correcto";
        }*/

    $correcto = true;
} else {
    $correcto = false;
}



?>

<div class="container">
    <div class="row justify-content-md-center" style="margin-top:15%">
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
        <?php } else { ?>
            <div class="alert alert-danger">Código incorrecto o vencido</div>
        <?php } ?>

    </div>
</div>

<?php include "./includes/footer.php"; ?>