<?php

try {
    require_once('../dbconfig.php');
    if (!$pdo) {
        throw new Exception("Erreur de connexion à la base de données.");
    }

    $stmt = $pdo->prepare("SELECT username, message, timestamp FROM messages ORDER BY timestamp DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<div class='message'><em>(" . date('d-m-Y, H:i', strtotime($row['timestamp'])) . ")</em> <strong>" . htmlspecialchars($row['username']) . " :</strong> " . htmlspecialchars($row['message'], ENT_QUOTES) . "</div>";
        }
    } else {
        echo "Aucun message pour l'instant.";
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}

?>