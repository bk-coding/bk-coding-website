<!--
BK-Coding.net
file: index.php
author: Bastien Kilian
 -->

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
				<fieldset class="categorytableau">
					<legend>Connexion</legend>
					<form action="authentification.php" method="post">
					<fieldset>
						<legend>Connexion</legend>
						<div><label for="username">Nom d'utilisateur :</label><input type="text" name="username" /></div>
						<div><label for="password">Mot de passe :</label><input type="password" name="password" /></div>
						<div><input type="reset" value="Effacer" /><input type="submit" value="Se connecter" /></div>
					</fieldset>
					</form>
				</fieldset>
			</div>
		</div>
	</body>
</html>

