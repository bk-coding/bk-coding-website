<!--
BK-Coding.net
file: parts/header.php
author: Bastien Kilian
 -->

<?php
session_start();
if (!$_SESSION['loggedin']) {
	header("Location: index.php");
	exit;
}
$username = $_SESSION['username'];
include('lang/FR.php');
$titlea = $lang[$title];
$message = $lang['message1.1'] . $username . $lang['message1.2'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Titre de la fenêtre -->
	<title><?= $lang["sitename"] . " - " . $titlea; ?></title>
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
			<div class="logo"><a href="https://bk-coding.net"><img src="img/logo.png" /></a></div>
			<div class="message"><?= $message; ?></div>
			<div class="menu">
				<a href="parts/infos.php" target="_blank">
					<div><i class="fa-solid fa-circle-info"></i></div>
				</a>
				<a href="deconnexion.php" onclick="return confirm('<?= $lang['deconnexion']; ?>');">
					<div><i class="fa-solid fa-power-off"></i></div>
				</a>
			</div>
		</div>