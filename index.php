<!--
BK-Coding.net
file: index.php
author: Bastien Kilian
 -->

<?php
session_start();
if ($_SESSION['loggedin']) {
	header("Location: dashboard.php");
	exit;
}
include('lang/FR.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $lang["sitename"] . " - " . $lang["slogan"]; ?></title>
	<!-- mise en place des Favicon's -->
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<!-- Style CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="bodycontainer">
		<div class="infocreation">
			<img src="img/logo.png" />
			<h1><?= $lang["sitename"]; ?></h1>
			<form action="authentification.php" method="post">
				<fieldset class="categoryajout">
					<legend>Connexion</legend>
					<div><label for="username">Nom d'utilisateur : </label><input type="text" name="username" /></div>
					<div><label for="password">Mot de passe : </label><input type="password" name="password" /></div>
					<div><input type="reset" value="Effacer" /><input type="submit" value="Se connecter" /></div>
				</fieldset>
			</form>
		</div>
	</div>
</body>

</html>