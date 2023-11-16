<?php require_once ('../../layouts/header.php'); ?>
<?php require_once ('../../../config/config.php'); ?>

<?php

if(isset($_GET["id"])){

    $id = $_GET["id"];

    $delete = $conn -> query("DELETE FROM admins WHERE id = '$id'");
    $delete->execute();

    header('Location: show-admins.php');
}

?>