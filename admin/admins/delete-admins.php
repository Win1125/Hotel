<?php require_once('../../config/config.php'); ?>
<?php require_once('../layouts/header.php'); ?>

<?php

if(isset($_GET["id"])){

    $id = $_GET["id"];

    $delete = $conn -> query("DELETE FROM admins WHERE id = '$id'");
    $delete->execute();

    echo"<script>
            Swal.fire({
                title: 'Estas Seguro?',
                text: 'No podrás revertir la eliminación!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminalo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon : 'warning',
                        title: 'Administrador Eliminado',
                        text: 'El administrador ha sido eliminado',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='admins.php';
                        }
                    });
                }
            });
        </script>";
}

?>