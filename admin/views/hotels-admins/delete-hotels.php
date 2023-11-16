<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

if(isset($_GET["id"])){

    $id = $_GET["id"];

    $getImage = $conn -> query("SELECT * FROM hotels WHERE id_hotel = '$id'");
    $getImage -> execute();

    $fetch = $getImage->fetch(PDO::FETCH_OBJ);
    unlink("hotelImages/".$fetch->image);

    $delete = $conn -> query("DELETE FROM hotels WHERE id_hotel = '$id'");
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
                        title: 'Hotel Eliminado',
                        text: 'El hotel ha sido eliminado',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='show-hotels.php';
                        }
                    });
                }
            });
        </script>";
}

?>