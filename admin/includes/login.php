<?php require_once ('../layouts/header.php'); ?>

<div class="row">
	<div class="col">
		<div class="card mt-3">
			<div class="card-body">
				<h5 class="card-title mt-5">Login</h5>
				<form method="POST" class="p-auto" action="_functions.php" autocomplete="off">
					<!-- Email input -->
					<div class="form-outline mb-4">
						<input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" autocomplete="off" pattern="[a-zA-Z0-9$@.-]{7,100}"/>
					</div>

					<!-- Password input -->
					<div class="form-outline mb-4">
						<input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="off" />
                        <input type="hidden" name="accion" value="acceso_user">
					</div>

					<!-- Submit button -->
                    <input type="submit" name="submit" class="btn btn-primary  mb-4 text-center" value="Ingresar">
				</form>
			</div>
		</div>
	</div>
</div>
</div>

<?php require_once ('../layouts/footer.php') ?>