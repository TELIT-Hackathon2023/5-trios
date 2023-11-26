<?php
error_reporting(E_ERROR);
session_start();

$prihlasenie = !isset($_SESSION["user"]) ? "Prihlasenie" : "Profil";
$link = !isset($_SESSION["user"]) ? "./login" : "./profile";
if (isset($_SESSION['user'])) {
	$username = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
}

?>
<!DOCTYPE html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/header.css">
	<link rel="stylesheet" href="./style/global.css">
	<link rel="manifest" href="./manifest.json">
	<link rel="stylesheet" href="./style/burger.css">



</head>
<!-- <link rel="stylesheet" href="style/reset.css"> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" async></script>

<header>
	<div class="header-container">
		<a class="logo" href="./">Parking spots</a>
		<div class="profile-div">



			<section class="top-nav">

				<input id="menu-toggle" type="checkbox">
				<label class='menu-button-container' for="menu-toggle">
					<div class='menu-button'></div>
				</label>
				<ul class="menu">
					<?php if (isset($_SESSION["user"])) : ?>

						<!--						<li><a href="./">Domov</a></li>-->

					<?php endif; ?>
					<?php if (isset($_SESSION["user"])) : ?>
						<li>

							<div class="user-section">
								<a href="./parking_map.php" class="login registration">Parkovacie miesta</a>
								<a href="./my_bookings.php" class="login registration">Moje bookings</a>
								<a href="./profile" class="login registration"><?php echo $username; ?></a>

							</div>

						</li>

					<?php else : ?>

						<li>
							<a href="./login" class="login">Prihlásenie</a>

						</li>
						<li>
							<a href="./registration" class="registration">Registrácia</a>
						</li>

					<?php endif; ?>
				</ul>
			</section>




		</div>

	</div>


</header>
<!-- <script>
	$(document).ready(function() {
		$('.burger').click(function() {
			$('.nav-bar').slideToggle();
		});
	});
</script> -->

<script>
	const header = document.querySelector('header');
	let lastScrollY = window.scrollY;

	window.addEventListener('scroll', () => {
		const currentScrollY = window.scrollY;

		if (currentScrollY > lastScrollY) {
			header.classList.add('header-hidden');
		} else {
			header.classList.remove('header-hidden');
		}

		lastScrollY = currentScrollY;
	});
</script>