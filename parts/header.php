<?php
session_start();
if (!$_SESSION['loggedin']) {
    exit("Vous ne pouvez pas avoir accès à cette page car vous n'êtes pas connecté.");  
}
$username = $_SESSION['username'];
include ('lang/FR.php');
$titlea = $lang[$title];
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $lang["sitename"]." - ".$titlea; ?></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
		<!-- Style CSS -->
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
<div class="header toolbar"><?php echo "Bienvenue " . $username . " ! Vous êtes connecté."; ?></div>