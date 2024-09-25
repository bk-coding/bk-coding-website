<?php
// Inclure le fichier de connexion à la base de données
require_once('./dbconfig.php');
// Préparer et exécuter la requête d'insertion
$stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
$stmt->execute([$_POST['username'], $_POST['message']]);

?>