<!--
BK-Coding.net
file: parts/header.php
author: Bastien Kilian
 -->

<?php
session_start();
if (isset($_SESSION['loggedin']) && !$_SESSION['loggedin']) {
	header("Location: index.php");
	exit;
}
$username = $_SESSION['username'];
include('lang/FR.php');
$titlea = htmlspecialchars($lang[$title]);
$message = htmlspecialchars($lang['message1.1']) . htmlspecialchars($username) . htmlspecialchars($lang['message1.2']);
$deconnexion = htmlspecialchars($lang['deconnexion']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Titre de la fenêtre -->
	<title><?= htmlspecialchars($lang["sitename"]) . " - " . $titlea; ?></title>
	<!-- mise en place des Favicon's -->
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<!-- Style CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/766d810226.js" crossorigin="anonymous"></script>
</head>

<body>
	<div class="bodycontainer">
		<div class="header toolbar">
			<div class="logo"><a href="https://bk-coding.net"><img src="img/logo.png" alt="Logo BK-Coding" /></a></div>
			<div class="message"><?= $message; ?></div>
			<div class="menu">
				<?php if ($_SESSION['role'] === 'admin') {
					echo '<a href="parametres.php"><div><i class="fa-solid fa-gears"></i><span class="noaff">Paramètres</span></div></a>';
				} ?>
				<a href="deconnexion.php" onclick="return confirm('<?= $deconnexion; ?>');" aria-label="Déconnexion">
					<div><i class="fa-solid fa-power-off"></i><span class="noaff">Déconnexion</span></div>
				</a>
			</div>
		</div>