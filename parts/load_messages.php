<?php
// Inclure le fichier de connexion à la base de données
require_once('./dbconfig.php');

// Récupérer tous les messages
$stmt = $pdo->prepare("SELECT username, message, timestamp FROM messages ORDER BY timestamp DESC");
$stmt->execute();
$result = $stmt->fetchAll();
// Affichage des messages
$result = $stmt->fetchAll(); // Récupérez toutes les lignes
if (count($result) > 0) {
    foreach ($result as $row) {
        echo "<div class='message'><strong>" . htmlspecialchars($row['username']) . ":</strong> " . htmlspecialchars($row['message']) . " <em>(" . date('Y-m-d H:i:s', strtotime($row['timestamp'])) . ")</em></div>";
    }
} else {
    echo "Aucun message pour l'instant.";
}

?>