<?php
// Inclure le fichier de connexion à la base de données
require_once('./dbconfig.php');
// Préparer et exécuter la requête d'insertion
$username = htmlspecialchars($_POST['username']);
$message = htmlspecialchars($_POST['message']);

$stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
if ($stmt->execute([$username, $message])) {
    echo "Message envoyé!";
} else {
    echo "Erreur en envoyant le message.";
}

?>