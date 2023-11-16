<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>

<?php


if (!isset($_SESSION['admin_name'])) {
    echo "<script>window.location.href= '" . ADMINURL . "admins/login-admins.php' </script>";
}

$hotels = $conn->query("SELECT * FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Buscar Bookings por Fecha</h5>
                <hr>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Del Dia</b></label>
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                                                                echo $_GET['from_date'];
                                                                            } ?>" class="form-control appointment_date-check-int" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b> Hasta el Dia</b></label>
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                                                                echo $_GET['to_date'];
                                                                            } ?>" class="form-control appointment_date-check-out" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Hotel</b></label> <br>
                                <select name="id_hotel" class="form-control">
                                    <option>Escoge un Hotel</option>
                                    <?php foreach ($allHotels as $hotel) :  ?>
                                        <option value="<?php echo $hotel->$id_hotel; ?>"><?php echo $hotel->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>----</b></label> <br>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Descargar</b></label> <br>
                                <a class="btn btn-success" href="../../includes/excel.php">Excel
                                    <i class="fa fa-table" aria-hidden="true"></i>
                                </a>
                                <a href="../../includes/reporte.php" class="btn btn-danger"><b>PDF</b></a>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "hotel");
                $where = "";
                if (isset($_GET['enviar'])) {
                    $busqueda = $_GET['busqueda'];
                    if (isset($_GET['busqueda'])) {
                        $where = "WHERE user.email LIKE'%" . $busqueda . "%' OR username  LIKE'%" . $busqueda . "%'
                                OR id_user  LIKE'%" . $busqueda . "%'";
                    }
                }
                ?>
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">Ingreso</th>
                            <th scope="col">Salida</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hotel</th>
                            <th scope="col">Room</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                            $from_date = $_GET['from_date'];
                            $to_date = $_GET['to_date'];

                            //$query = "SELECT * FROM booking JOIN rooms ON booking.id_room = rooms.id_room WHERE rooms.id_hotel = '$hotel' AND (booking.check_in BETWEEN '$from_date' AND '$to_date') or (booking.check_out BETWEEN '$from_date' AND '$to_date')";

                            $query = "SELECT * FROM booking WHERE (check_in BETWEEN '$from_date' AND '$to_date') or (check_out BETWEEN '$from_date' AND '$to_date')";
                            $query_run = mysqli_query($conexion, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $fila) { ?>
                                    <tr>
                                        <td><?php echo $fila['check_in']; ?></td>
                                        <td><?php echo $fila['check_out']; ?></td>
                                        <td><?php echo $fila['email']; ?></td>
                                        <td><?php echo $fila['phone_number']; ?></td>
                                        <td><?php echo $fila['full_name']; ?></td>
                                        <td><?php echo $fila['hotel_name']; ?></td>
                                        <td><?php echo $fila['room_name']; ?></td>

                                        <td><?php if ($fila['status'] == "Finished") { ?>
                                                <a class="btn btn-small btn-success" aria-disabled="true"><?php echo $fila['status']; ?> <i class="fa-solid fa-rotate-right"></i></a>
                                            <?php } else { ?>
                                                <a href="status-bookings.php?id=<?php echo $fila['id_booking']; ?>" class="btn btn-small btn-success"><?php echo $fila['status']; ?> <i class="fa-solid fa-rotate-right"></i></a>
                                            <?php } ?>
                                        </td>

                                        <td><?php echo $fila['payment']; ?></td>

                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td><?php echo "No se encontraron resultados"; ?></td>
                                </tr>
                    </tbody>
            <?php
                            }
                        }
            ?>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="../../../sw/dist/sweetalert2.all.js"></script>
<script src="../../../sw/dist/sweetalert2.all.min.js"></script>
<script src="../../../sw/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="../../DataTables/js/datatables.min.js"></script>
<script type="text/javascript" src="../../DataTables/js/jquery.dataTables.min.js"></script>
<script src="../../DataTables/js/dataTables.bootstrap4.min.js"></script>

<script src="../../js/page.js"></script>
<script src="../../js/buscador.js"></script>
<script src="../../js/user.js"></script>

<?php require_once('../../layouts/footer.php'); ?>