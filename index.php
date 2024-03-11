<?php
include ('lang/FR.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $lang["sitename"]." - ".$lang["slogan"]; ?></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
		<!-- Style CSS -->
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="boite">
			<div class="infocreation">
				<h1><?= $lang["sitename"]; ?></h1>
				<h3>Hello, world!</h3>
				<p>
				Le site est en cours de création, et il y a du boulot !<br>
				Revenez dans quelques temps, et vous pourrez admirer le travail.
				</p>
				<form action="authentification.php" method="post">
					Nom d'utilisateur: <input type="text" name="username" /><br />
					Mot de passe: <input type="password" name="password" /><br />
					<input type="submit" value="Se connecter" />
				</form>
			</div>
		</div>

		<!-- Optional JavaScript -->

		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
	</body>
</html>

