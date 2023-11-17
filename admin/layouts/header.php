<?php

session_set_cookie_params(60 * 60 * 24 * 1); // 60 seconds, 60 minutes, 24 hours, 1 days
session_start();
define("ADMINURL", "http://localhost/Hotel/admin/");

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Admin Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo ADMINURL; ?>styles/style.css" rel="stylesheet">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://kit.fontawesome.com/1bf359b2a0.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../css/es.css">
	<script src="../js/jquery.min.js"></script>
	<script src="../js/resp/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../resources/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../resources/css/animate.css">
    <link rel="stylesheet" href="../../resources/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../resources/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../resources/css/magnific-popup.css">
    <link rel="stylesheet" href="../../resources/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../resources/css/jquery.timepicker.css">
    <link rel="stylesheet" href="../../resources/css/flaticon.css">
    <link rel="stylesheet" href="../../resources/css/style.css">
</head>

<body>
	<div id="wrapper">
		<nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="<?php echo ADMINURL; ?>">DASHBOARD</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarText">
					<?php if (isset($_SESSION['username'])) : ?>
						<ul class="navbar-nav side-nav">
							<li class="nav-item">
								<a class="nav-link" style="margin-left: 20px;" href="<?php echo ADMINURL; ?>">Home
									<span class="sr-only">(current)</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>views/admins/show-admins.php" style="margin-left: 20px;">Admins</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>views/hotels-admins/show-hotels.php" style="margin-left: 20px;">Hotels</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>views/rooms-admins/show-rooms.php" style="margin-left: 20px;">Rooms</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>views/bookings-admins/show-bookings.php" style="margin-left: 20px;">Bookings</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>views/users-admins/show-users.php" style="margin-left: 20px;">Users</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>views/contacts-admins/show-contacts.php" style="margin-left: 20px;">Contacts</a>
							</li>
						</ul>
					<?php endif; ?>
					<ul class="navbar-nav ml-md-auto d-md-flex">
						<?php if (!isset($_SESSION['username'])) : ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>includes/login.php">login
								</a>
							</li>
						<?php else : ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo ADMINURL; ?>">Home
									<span class="sr-only">(current)</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link  dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo $_SESSION['username'] ?>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?php echo ADMINURL; ?>includes/_sesion/cerrarSesion.php">Logout</a>
								</div>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">