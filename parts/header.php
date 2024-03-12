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
		<!-- Style CSS -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://kit.fontawesome.com/766d810226.js" crossorigin="anonymous"></script>
	</head>
	<body>
        <div class="bodycontainer">
            <div class="header toolbar">
				<div class="logo"><a href="https://bk-coding.net"><img src="img/logo.webp" /></a></div>
				<?php echo "<div class=\"message\"> Bienvenue " . $username . " ! Vous êtes connecté.</div>"; ?>
				<div class="menu"><a href="deconnexion.php"><i class="fa-solid fa-power-off"></i></a></div>
			</div>