<?php
date_default_timezone_set('Europe/Paris'); // Assurez-vous que le fuseau horaire est correct

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
            // Convertir le timestamp récupéré en heure française
            // Supposons que le timestamp est stocké au format UTC
            $messageTime = new DateTime($row['timestamp'], new DateTimeZone('UTC')); // Création de l'objet DateTime avec le fuseau horaire UTC
            $messageTime->setTimezone(new DateTimeZone('Europe/Paris')); // Changer le fuseau horaire vers Paris

            // Formatage de la date/heure
            echo "<div class='messagechat'><em>(" . $messageTime->format('d-m-Y, H:i') . ")</em> <strong>" . htmlspecialchars($row['username']) . " :</strong> " . htmlspecialchars($row['message'], ENT_QUOTES) . "</div>";
        }
    } else {
        echo "Aucun message pour l'instant.";
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
