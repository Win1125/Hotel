<?php require_once ('../layouts/header.php'); ?>
<?php require_once ('../../config/config.php'); ?>

<?php

if(!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href= '".ADMINURL."admins/login-admins.php' </script>";
}

	$users = $conn->query("SELECT * FROM user");
	$users->execute();

	$allUsers = $users->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Users</h5>
				<a href="create-users.php" class="btn btn-primary mb-4 text-center float-right">Create Users</a>
				<table class="table">
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
						<?php foreach($allUsers as $user) : ?>
							<tr>
								<th scope="row"><?php echo $user -> id_user ?></th>
								<td><?php echo $user -> username ?></td>
								<td><?php echo $user -> email ?></td>
								<td><?php echo $user -> created_at ?></td>
								<td>
                                	<a href="update-users.php?id=<?php echo $user->id_user ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                	<a href="delete-users.php?id=<?php echo $user->id_user ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            	</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
require_once('../layouts/footer.php');
?>