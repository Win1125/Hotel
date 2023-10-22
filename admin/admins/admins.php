<?php require_once ('../layouts/header.php'); ?>
<?php require_once ('../../config/config.php'); ?>

<?php

if(!isset($_SESSION['admin_name'])) {
	echo "<script>window.location.href= '".ADMINURL."admins/login-admins.php' </script>";
}

	$admins = $conn->query("SELECT * FROM admins");
	$admins->execute();

	$allAdmins = $admins->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4 d-inline">Admins</h5>
				<a href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Admin Name</th>
							<th scope="col">Email</th>
							<th scope="col">Created At</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($allAdmins as $admin) : ?>
							<tr>
								<th scope="row"><?php echo $admin -> id ?></th>
								<td><?php echo $admin -> admin_name ?></td>
								<td><?php echo $admin -> email ?></td>
								<td><?php echo $admin -> created_at ?></td>
								<td>
                                	<a class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                	<a class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
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