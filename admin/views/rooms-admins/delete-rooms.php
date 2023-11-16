<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

if(isset($_GET["id"])){

    $id = $_GET["id"];

    $getImage = $conn -> query("SELECT * FROM rooms WHERE id_room = '$id'");
    $getImage -> execute();

    $fetch = $getImage->fetch(PDO::FETCH_OBJ);
    unlink("roomImages/".$fetch->image);

    $delete = $conn -> query("DELETE FROM rooms WHERE id_room = '$id'");
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
                        title: 'Habitación Eliminada',
                        text: 'La habitación ha sido eliminada',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='show-rooms.php';
                        }
                    });
                }
            });
        </script>";
}

?>