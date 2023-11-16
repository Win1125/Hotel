<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>

<?php

$validar = $_SESSION['admin_name'];

if(!isset($validar)) {
	echo "<script>window.location.href='".ADMINURL."includes/login.php' </script>";
	die();
}

$users = $conn->query("SELECT * FROM user");
$users->execute();

$allUsers = $users->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Users</h5>
				<hr>
				<div>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
						<span class="glyphicon glyphicon-plus"></span> Nuevo usuario <i class="fa fa-plus"></i> </a>
					</button>
					<a class="btn btn-success" href="../../includes/excel.php">Excel
						<i class="fa fa-table" aria-hidden="true"></i>
					</a>
					<a href="../../includes/reporte.php" class="btn btn-danger"><b>PDF</b></a>
				</div>
				<br>
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
				<!--<a href="create-users.php" class="btn btn-primary mb-4 text-center float-right">Create Users</a>-->

				<table class="table table-striped table-dark table_id" id="table_id">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">User Name</th>
							<th scope="col">Email</th>
							<th scope="col">Created At</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allUsers as $user) : ?>
							<tr>
								<th scope="row"><?php echo $user->id_user ?></th>
								<td><?php echo $user->username ?></td>
								<td><?php echo $user->email ?></td>
								<td><?php echo $user->created_at ?></td>
								<td>
									<a class="btn btn-small btn-warning" href="update-users.php?id=<?php echo $user->id_user ?>"><i class="fa-solid fa-pen-to-square"></i></a>
									<a class="btn btn-small btn-danger btn-del" href="delete-users.php?id=<?php echo $user->id_user ?>"><i class="fa-solid fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
				<script>
					$('.btn-del').on('click', function(e) {
						e.preventDefault();
						const href = $(this).attr('href')

						Swal.fire({
							title: 'Estas seguro de eliminar este usuario?',
							text: "¡No podrás revertir esto!!",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Si, eliminar!',
							cancelButtonText: 'Cancelar!',
						}).then((result) => {
							if (result.value) {
								if (result.isConfirmed) {
									Swal.fire(
										'Eliminado!',
										'El usuario fue eliminado.',
										'success'
									)
								}

								document.location.href = href;
							}

						})
					})
				</script>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h3 class="modal-title" id="exampleModalLabel">Registro de Usuarios</h3>
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="../../includes/validar.php" method="POST">

					<div class="form-outline mb-4 mt-4">
						<input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
					</div>

					<div class="form-outline mb-4">
						<input type="text" name="username" id="form2Example1" class="form-control" placeholder="user name" />
					</div>
					<div class="form-outline mb-4">
						<input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
					</div>

					<br>
					<div class="mb-3">
						<input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar_usuario">
						<a href="show-user.php" class="btn btn-danger">Cancelar</a>
					</div>
				</form>
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