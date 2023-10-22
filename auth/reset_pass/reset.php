<?php

require '../../includes/header.php';


if (isset($_GET['email'])  && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
} else {
    header("Location: ../login.php");
}

?>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row justify-content-md-center mt-5 mb-5">
            <form class="col-3" action="verificartoken.php" method="POST">
                <h2>Restablecer Password</h2>
                <div class="mb-3">
                    <label for="c" class="form-label">Codigo</label>
                    <input type="number" class="form-control" id="c" name="codigo">
                    <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" class="form-control" id="c" name="token" value="<?php echo $token; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Restablecer</button>
            </form>
        </div>
    </div>
</section>

<?php require '../../includes/footer.php' ?>