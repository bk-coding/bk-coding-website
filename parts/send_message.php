<?php

try {
    require_once('../dbconfig.php');

    $username = $_POST['username'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->execute([$username, $message]);
    echo "Message envoyé!";
} catch (PDOException $e) {
    echo "Erreur lors de l'envoi du message: " . $e->getMessage();
}

?>