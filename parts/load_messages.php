<?php
// Inclure le fichier de connexion à la base de données
require_once('./dbconfig.php');

// Récupérer tous les messages
$stmt = $pdo->prepare("SELECT username, message, timestamp FROM messages ORDER BY timestamp DESC");
$stmt->execute();
$result = $stmt->fetch();
// Affichage des messages
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='message'><strong>" . $row['username'] . ":</strong> " . $row['message'] . " <em>(" . $row['timestamp'] . ")</em></div>";
    }
} else {
    echo "Aucun message pour l'instant.";
}
?>