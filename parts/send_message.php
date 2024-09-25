<?php

try {
    require_once('../dbconfig.php');

    function clean_message($message)
    {
        // Autoriser certains caractères spéciaux, mais désinfecter les autres
        return htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); // Pour échapper les guillemets également
    }

    // Préparer et exécuter la requête d'insertion
    $username = htmlspecialchars($_POST['username']);
    $message = clean_message($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->execute([$username, $message]);
    echo "Message envoyé!";
} catch (PDOException $e) {
    echo "Erreur lors de l'envoi du message: " . $e->getMessage();
}

?>