<!--
BK-Coding.net
file: dashboard.php
author: Bastien Kilian
 -->

<?php 
$title = "dashboard";
include('parts/header.php');
require_once('dbconfig.php');
session_start();
?>

<div class="bodycontent">
    <?php
    // Fetch les sections de la base de données
    $queryList = ['Applis', 'Clients', 'Outils Admin', 'Outils', 'Autre'];
    $userSections = [];
    $role = $_SESSION['role'] ?? 'guest'; // Définit un rôle par défaut

    foreach ($queryList as $type) {
        $stmt = $pdo->prepare("SELECT * FROM sections WHERE type_section = ?");
        $stmt->execute([$type]);
        $links = $stmt->fetchAll();
        
        // Filtrer les sections selon le rôle de l'utilisateur
        if ($role === 'admin'){
        } elseif ($role === 'user' && in_array($type, ['Outils'])) {
            $userSections[$type] = $links;
        } elseif ($role === 'guest' && $type === 'Autre') {
            $userSections[$type] = $links;
        }
    }

    // Affichage dynamique des liens selon le rôle de l'utilisateur
    foreach ($userSections as $legend => $links) {
        if (empty($links)) continue; // Passer si aucun lien
        echo '<fieldset class="category">';
        echo "<legend>$legend</legend>";
        foreach ($links as $link) {
            echo '<a name="'.$link['nom_interne'].'" target="'.$link['cible'].'" href="'.$link['adresse_lien'].'">';
            echo '<div class="bouton">';
            echo '<div><i class="fa-solid '.$link['icon'].'"></i></div>';
            echo '<div>'.$link['titre_bouton'].'</div>';
            echo '</div></a>';
        }
        echo '</fieldset>';
    }
    ?>
</div>

<?php include('parts/footer.php'); ?>