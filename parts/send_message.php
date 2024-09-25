<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de connexion à la base de données
require_once('./dbconfig.php');
// Préparer et exécuter la requête d'insertion
$username = htmlspecialchars($_POST['username']);
$message = htmlspecialchars($_POST['message']);

$stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
try {
    $stmt->execute([$username, $message]);
    echo "Message envoyé!";
} catch (PDOException $e) {
    echo "Erreur lors de l'envoi du message: " . $e->getMessage();
}

?>