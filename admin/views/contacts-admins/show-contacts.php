<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

$validar = $_SESSION['username'];

if (!isset($validar)) {
    echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}

$contacts = $conn->query("SELECT * FROM contacts order by id_contact DESC");
$contacts->execute();

$allContacts = $contacts->fetchAll(PDO::FETCH_OBJ);


if (isset($_GET['seen'])) {

    if ($_GET['seen'] == 'all') {

        $status = 5;

        $update = $conn->prepare("UPDATE contacts SET id_status = :status");

        $update->execute([
            ":status" => $status
        ]);

        if ($update) {
            echo    "<script>
                    Swal.fire({
                        icon : 'info',
                        title: 'Actualización Exitosa',
                        text: 'Todos los contactos fueron marcados como leídos',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='show-contacts.php';
                        }
                    });
                </script>";
        } else {
            echo    "<script>
                    Swal.fire({
                        icon : 'error',
                        title: 'Ups! Hay un problema',
                        text: 'Revisa, hay algo que no va bien',
                        type: 'error'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='show-contacts.php';
                        }
                    });
                </script>";
        }
    } else {
        $id = $_GET['seen'];

        $status = 5;

        $update = $conn->prepare("UPDATE contacts SET id_status = :status WHERE id_contact = '$id'");

        $update->execute([
            ":status" => $status
        ]);

        if ($update) {
            echo    "<script>
                    Swal.fire({
                        icon : 'info',
                        title: 'Actualización Exitosa',
                        text: 'Contacto Marcado como leído',
                        type: 'success'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='show-contacts.php';
                        }
                    });
                </script>";
        }
    }
}


if (isset($_GET['del'])) {

    if ($_GET['del'] == 'all') {

        $delete = $conn->query("DELETE FROM contacts");
        $delete->execute();

        if ($delete) {
            echo    "<script>
                        Swal.fire({
                            icon : 'warning',
                            title: 'Contacto Eliminado',
                            text: 'El contacto ha sido eliminado',
                            type: 'success'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location='show-contacts.php';
                            }
                        });
                    </script>";
        }else{
            echo    "<script>
                        Swal.fire({
                            icon : 'error',
                            title: 'Ups! Hay un problema',
                            text: 'Revisa, hay algo que no va bien',
                            type: 'error'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location='show-contacts.php';
                            }
                        });
                    </script>";
        }

    } else {
        $id = $_GET['del'];

        $delete = $conn->query("DELETE FROM contacts WHERE id_contact = '$id'");
        $delete->execute();

        if ($delete) {
            echo    "<script>
                        Swal.fire({
                            icon : 'warning',
                            title: 'Contacto Eliminado',
                            text: 'El contacto ha sido eliminado',
                            type: 'success'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location='show-contacts.php';
                            }
                        });
                    </script>";
        }
    }
}

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Contacts</h4>

                <div class="text-end">
                    <a href="?seen=all" class="btn btn-dark rounded-pill btn-sm shadow-none"><i class="fa-solid fa-list-check"></i> Mark All Read</a>
                    <a href="?del=all" class="btn btn-danger rounded-pill btn-sm shadow-none"><i class="fa-solid fa-trash"></i> Delete All</a>
                </div>

                <div class="table-responsive-md mt-3" style="height: 300px; overflow-y: scroll;">
                    <table class="table table-hover border">
                        <thead class="sticky-top">
                            <tr class="bg-dark text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allContacts as $contact) : ?>
                                <?php
                                $seen = "";
                                if ($contact->id_status != 5) {
                                    $seen = "<a href='?seen=$contact->id_contact' class='btn btn-sm rounded-pill btn-primary'>Mark Read</a><br>";
                                }
                                $seen .= "<a href='?del=$contact->id_contact' class='btn btn-sm rounded-pill btn-danger mt-1'>Delete</a>";
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $contact->name ?></td>
                                    <td><?php echo $contact->email ?></td>
                                    <td><?php echo $contact->subject ?></td>
                                    <td><?php echo $contact->message ?></td>
                                    <td><?php echo $contact->created_at ?></td>
                                    <td><?php echo $seen ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once('../../layouts/footer.php'); ?>