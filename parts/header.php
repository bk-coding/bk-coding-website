<?php
session_start();
if (!$_SESSION['loggedin']) {
	header("Location: index.php");
    exit;  
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
		<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
		<link rel="manifest" href="favicon/site.webmanifest">
		<script src="https://kit.fontawesome.com/766d810226.js" crossorigin="anonymous"></script>
	</head>
	<body>
        <div class="bodycontainer">
            <div class="header toolbar">
				<div class="logo"><a href="https://bk-coding.net"><img src="img/logo.webp" /></a></div>
				<?php echo "<div class=\"message\"> Bienvenue " . $username . " ! Vous êtes connecté.</div>"; ?>
				<div class="menu"><a href="deconnexion.php"><i class="fa-solid fa-power-off"></i></a></div>
			</div>