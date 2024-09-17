<?php
session_start();
if ($_SESSION['loggedin']){
	header("Location: dashboard.php");
	exit;
}
include ('lang/FR.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $lang["sitename"]." - ".$lang["slogan"]; ?></title>
		<!-- Style CSS -->
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="bodycontainer">
			<div class="infocreation">
				<h1><?= $lang["sitename"]; ?></h1>
				<h3>Hello, world!</h3>
				<p>Le site est en cours de création, et il y a du boulot !<br />
				Revenez dans quelques temps, et vous pourrez admirer le travail.</p>
				<form action="authentification.php" method="post">
					<fieldset>
						<legend>Connexion</legend>
						<div><label for="username">Nom d'utilisateur :</label><input type="text" name="username" /></div>
						<div><label for="password">Mot de passe :</label><input type="password" name="password" /></div>
						<div><input type="reset" value="Effacer" /><input type="submit" value="Se connecter" /></div>
					</fieldset>
				</form>
			</div>
		</div>
	</body>
</html>

