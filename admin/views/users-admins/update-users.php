<?php require_once('../../layouts/header.php'); ?>
<?php require_once('../../../config/config.php'); ?>


<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $conn->query("SELECT * FROM user WHERE id_user = '$id'");
    $user->execute();
    $userSingle = $user->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['email'])) {
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
            $username = $_POST['username'];
            $email = $_POST['email'];
            $update = $conn->prepare("UPDATE user SET username = :username, email = :email WHERE id_user = '$id'");
            $update->execute([
                ":username" => $username,
                ":email" => $email
            ]);
            if ($update) {
                echo    "<script>
						Swal.fire({
							icon : 'info',
							title: 'Actualización Exitosa',
							text: 'Usuario actualizado',
							type: 'success'
						}).then((result) => {
							if(result.isConfirmed){
								window.location='show-users.php';
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
                <h5 class="card-title mb-5 d-inline">Update Users</h5>
                <form method="POST" action="update-users.php?id=<?php echo $id; ?>">
                    <div class="form-outline mb-4 mt-4">
                        <label for="idUser">ID User</label>
                        <input type="text" value="<?php echo $userSingle->id_user; ?>" name="id" id="idUser" class="form-control" placeholder="id" readonly />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="email" value="<?php echo $userSingle->email; ?>" name="email" id="form2Example1" class="form-control" placeholder="email" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" value="<?php echo $userSingle->username; ?>" name="username" id="form2Example1" class="form-control" placeholder="user name" />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('../../layouts/footer.php'); ?>