<?php
try {
    if (!$pdo) {
        throw new Exception("Erreur de connexion à la base de données.");
    }

    $stmt = $pdo->prepare("SELECT username, message, timestamp FROM messages ORDER BY timestamp DESC");
    $stmt->execute();

    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<div class='message'><strong>" . htmlspecialchars($row['username']) . ":</strong> " . htmlspecialchars($row['message']) . " <em>(" . date('Y-m-d H:i:s', strtotime($row['timestamp'])) . ")</em></div>";
        }
    } else {
        echo "Aucun message pour l'instant.";
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>