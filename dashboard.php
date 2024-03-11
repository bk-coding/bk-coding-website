<?php
session_start();

$username = $_SESSION['username'];

echo "Bienvenue " . $username . " ! Vous êtes connecté.";
?>