<?php require_once('../layouts/header.php'); ?>
<?php require_once('../../config/config.php'); ?>

<?php

if (isset($_GET['id'])) {

	$id = $_GET['id'];

    $admin = $conn->query("SELECT * FROM admins WHERE id = '$id'");
    $admin->execute();

    $adminSingle = $admin->fetch(PDO::FETCH_OBJ);

    if (isset($_POST['submit'])) {

        if (empty($_POST['admin_name']) || empty($_POST['email'])) {
            echo "<script type='text/javascript'>
					Swal.fire({
						icon : 'error',
						title: 'Ocurrió un error inesperado',
						text: 'No has llenado todos los campos que son requeridos',
						type: 'error',
						confirmButtonText: 'Aceptar'
					});
				  </script>";
        } else {

            $admin_name = $_POST['admin_name'];
            $email = $_POST['email'];

            $update = $conn->prepare("UPDATE admins SET admin_name = :admin_name, email = :email WHERE id = '$id'");

            $update->execute([
                ":admin_name" => $admin_name,
                ":email" => $email
            ]);

            if ($update) {
                echo    "<script>
						Swal.fire({
							icon : 'info',
							title: 'Actualización Exitosa',
							text: 'Administrador actualizado',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='admins.php';
							}
						});
					</script>";
            }
        }
    }
}

?>


<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-5 d-inline">Update Admins</h5>
				<form method="POST" action="update-admins.phpid=<?php echo $id; ?>">
					<div class="form-outline mb-4 mt-4">
						<label for="idAdmin">ID User</label>
						<input type="text" value="<?php echo $adminSingle->id; ?>" name="id" id="idAdmin" class="form-control" placeholder="id" readonly />
					</div>

					<div class="form-outline mb-4 mt-4">
						<input type="email" value="<?php echo $adminSingle->email; ?>" name="email" id="form2Example1" class="form-control" placeholder="email" />
					</div>

					<div class="form-outline mb-4">
						<input type="text" value="<?php echo $adminSingle->admin_name; ?>" name="admin_name" id="form2Example1" class="form-control" placeholder="admin name" />
					</div>

					<!-- Submit button -->
					<button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once('../layouts/footer.php'); ?>