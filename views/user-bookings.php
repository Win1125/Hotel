<?php

require_once('../includes/header.php');
require_once('../config/config.php');

if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href='" . APPURL . "'</script>";
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if ($_SESSION['id_user'] != $id) {
        echo "<script>window.location.href='" . APPURL . "'</script>";
    }
    
    $bookings = $conn->query("SELECT b.id_booking, u.username 
                              AS user_name, b.phone_number, b.check_in, b.check_out, r.room_name, h.name 
                              AS hotel_name, s.name AS status_name, b.payment FROM booking b 
                              JOIN users u ON b.id_user = u.id_user 
                              JOIN rooms r ON b.id_room = r.id_room 
                              JOIN hotels h ON r.id_hotel = h.id_hotel 
                              JOIN status s ON b.id_status = s.id_status 
                              WHERE u.id_user = '$id';");
    $bookings->execute();

    $allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "<script>window.location.href='" . APPURL . "404.php'</script>";
}

?>

<div class="container">

    <h1 class="text-center mt-3">My Bookings</h1>

    <?php if (count($allBookings) > 0) : ?>
        <table class="table table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col"># Booking</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Hotel</th>
                    <th scope="col">Room</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allBookings as $book) { ?>
                    <tr>
                        <th scope="row"><?php echo $book->id_booking ?></th>
                        <td><?php echo $book->check_in ?></td>
                        <td><?php echo $book->check_out ?></td>
                        <td><?php echo $book->user_name ?></td>
                        <td><?php echo $book->hotel_name ?></td>
                        <td><?php echo $book->room_name ?></td>
                        <td><?php echo $book->payment ?></td>
                        <td><?php echo $book->status_name ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else : ?>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
        </svg>

        <div class="alert alert-info d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <div>
                &nbsp; &#160; Aún no tienes ninguna reserva con nosotros, pero no te preocupes! Te invitamos q ue reserves ya mismo! <a href="http://localhost/Hotel/" class="alert-link">RESERVAR AQUÍ</a>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php

require_once('../includes/footer.php');

?>