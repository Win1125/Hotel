<?php
require '../includes/header.php';
require_once '../config/config.php';
?>

<div class="container">
    <div class="row justify-content-md-center" style="margin-top:15%">
        <form class="col-3" action="./reset_pass/restablecer.php" method="POST">
            <h2>Restablecer Password</h2>
            <div class="mb-3">
                <label for="c" class="form-label">Email</label>
                <input type="email" class="form-control" id="c" name="email">

            </div>

            <button type="submit" class="btn btn-primary">Restablecer</button>
        </form>
    </div>
</div>

<?php
require '../includes/footer.php';
?>