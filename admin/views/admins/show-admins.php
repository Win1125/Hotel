<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>

<?php

$validar = $_SESSION['username'];

if(!isset($validar)) {
	echo "<script>window.location.href='".ADMINURL."includes/login.php' </script>";
	die();
}


/*$admins = $conn->query("SELECT users.id_user, users.username, users.email, users.created_at FROM users 
						JOIN user_roles ON users.id_user = user_roles.id_user 
						JOIN roles ON user_roles.id_role = roles.id_role 
						WHERE roles.role_name = 'Administrador';");*/
$admins = $conn->query("SELECT * FROM `staff_users`");
$admins->execute();

$allAdmins = $admins->fetchAll(PDO::FETCH_OBJ);


$rols = $conn->query(" SELECT * FROM roles");
$rols->execute();

$allRols = $rols->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Admins</h5>
				<hr>
				<div>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
						<span class="glyphicon glyphicon-plus"></span> Nuevo Admin <i class="fa fa-plus"></i> </a>
					</button>
					<a class="btn btn-success" href="../../includes/excel.php">Excel
						<i class="fa fa-table" aria-hidden="true"></i>
					</a>
					<a href="../../includes/reporte.php" class="btn btn-danger"><b>PDF</b></a>
				</div>
				<br>
				<?php
				$conexion = mysqli_connect("localhost", "root", "", "hotel_a");
				$where = "";
				if (isset($_GET['enviar'])) {
					$busqueda = $_GET['busqueda'];
					if (isset($_GET['busqueda'])) {
						$where = "WHERE email LIKE'%" . $busqueda . "%' OR username  LIKE'%" . $busqueda . "%'
							OR rol_name  LIKE'%" . $busqueda . "%'";
					}
				}
				?>

				<!--<a href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>-->

				<table class="table table_id" id="table_id">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Admin Name</th>
							<th scope="col">Email</th>
							<th scope="col">Rol</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allAdmins as $admin) : ?>
							<tr>
								<th scope="row"><?php echo $admin->id_user ?></th>
								<td><?php echo $admin->username ?></td>
								<td><?php echo $admin->email ?></td>
								<td><?php echo $admin->role_name ?></td>
								<td>
									<a href="update-admins.php?id=<?php echo $admin->id_user ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
									<!--<a href="delete-admins.php?id=<?php echo $admin->id_user ?>" class="btn btn-small btn-danger btn-del"><i class="fa-solid fa-trash"></i></a>-->
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
							title: 'Estas seguro de eliminar este administrador?',
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
										'El administrador fue eliminado.',
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
				<h3 class="modal-title" id="exampleModalLabel">Registro de Administradores</h3>
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
						<input type="text" name="admin_name" id="form2Example1" class="form-control" placeholder="admin name" />
					</div>
					<div class="form-outline mb-4">
						<input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
					</div>

					<div class="form-outline mb-4">
						<input type="password" name="password2" id="form2Example1" class="form-control" placeholder="verified password" />
					</div>

					<select name="rol_name" class="form-control">
						<option>Rol</option>
						<?php foreach ($allRols as $rol): ?>
							<option value="<?php echo $rol -> role_name; ?>"><?php echo $rol -> role_name; ?></option>
						<?php endforeach; ?>
					</select>

					<br>
					<div class="mb-3">
						<input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar_admin">
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