<?php

try {
    require_once('../dbconfig.php');
    // Préparer et exécuter la requête d'insertion
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->execute([$username, $message]);
    echo "Message envoyé!";
} catch (PDOException $e) {
    echo "Erreur lors de l'envoi du message: " . $e->getMessage();
}

?>