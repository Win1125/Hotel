<!doctype html>
<?php

require_once('../includes/header.php');
require_once('../config/config.php');

?>


<div class="hero-wrap js-fullheight" style="background-image: url(../resources/images/image_2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <h1 class="mb-4">Pay Page For Your Room: <?php echo $_SESSION['username']; ?></h1>

                <div class="container">
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script src="https://www.paypal.com/sdk/js?client-id=AekeuaIg0EkwixS1M0DU3KiCcqX-DxrZOPEmVp_vihPcxtAYlv7L_FNeHRcxnLWRV3MXdpp1XdBfiMWL&currency=USD"></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>

                    <!--

                        URL Sandbox para probar usuarios: https://sandbox.paypal.com

                        usuario paypal: sb-itpo927785691@personal.example.com
                        contraseña: !l1/SuMD

                        usuario paypal business: sb-od1yc26169716@business.example.com
                        contraseña: ec$vH0A<
                    -->

                    <script>
                        paypal.Buttons({
                            // Sets up the transaction when a payment button is clicked
                            createOrder: (data, actions) => {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: '<?php echo $_SESSION['price']; ?>' // Can also reference a variable or function
                                        }
                                    }]
                                });
                            },
                            // Finalize the transaction after payer approval
                            onApprove: (data, actions) => {
                                return actions.order.capture().then(function(orderData) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Perfecto!',
                                        text: 'Tu reserva ha sido confirmada muchas gracias por confiar en nosotros :3',
                                        type: 'success'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = 'http://localhost/Hotel/';
                                        }
                                    });
                                });
                            }
                        }).render('#paypal-button-container');
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>

<?php

require_once('../includes/footer.php');

?>