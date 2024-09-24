<!--
BK-Coding.net
file: parametres.php
author: Bastien Kilian
-->

<?php
$title = "parametres";
include('parts/header.php');
require_once('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajout ou mise à jour d'un lien
    if (isset($_POST['type_section'], $_POST['nom_interne'], $_POST['cible'], $_POST['adresse_lien'], $_POST['icon'], $_POST['titre_bouton'])) {
        if ($_POST['id'] == 0) { // Ajout
            $stmt = $pdo->prepare("INSERT INTO sections (type_section, nom_interne, cible, adresse_lien, icon, titre_bouton) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['type_section'], $_POST['nom_interne'], $_POST['cible'], $_POST['adresse_lien'], $_POST['icon'], $_POST['titre_bouton']]);
            echo "<script>
                window.onload = function() {
                    afficheCat('catliens');
                };
            </script>";
        } else { // Mise à jour
            $stmt = $pdo->prepare("UPDATE sections SET nom_interne = ?, cible = ?, adresse_lien = ?, icon = ?, titre_bouton = ? WHERE id = ?");
            $stmt->execute([$_POST['nom_interne'], $_POST['cible'], $_POST['adresse_lien'], $_POST['icon'], $_POST['titre_bouton'], $_POST['id']]);
            echo "<script>
                window.onload = function() {
                    afficheCat('catliens');
                };
            </script>";
        }
    }

    // Suppression d'un lien
    if (isset($_POST['delete']) && $_POST['id'] > 0) {
        $stmt = $pdo->prepare("DELETE FROM sections WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        echo "<script>
                window.onload = function() {
                    afficheCat('catliens');
                };
            </script>";
    }

    // Ajout ou mise à jour d'un utilisateur
    if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['role'])) {
        if ($_POST['user_id'] == 0) { // Ajout
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->execute([$_POST['username'], $password, $_POST['email'], $_POST['role']]);
            echo "<script>
                window.onload = function() {
                    afficheCat('catUsers');
                };
            </script>";
        } else { // Mise à jour
            $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ?, email = ?, role = ? WHERE id = ?");
            $stmt->execute([$_POST['username'], $_POST['password'], $_POST['email'], $_POST['role'], $_POST['user_id']]);
            echo "<script>
                window.onload = function() {
                    afficheCat('catUsers');
                };
            </script>";
        }
    }

    // Suppression d'un utilisateur
    if (isset($_POST['deleteUser']) && $_POST['user_id'] > 0) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_POST['user_id']]);
        echo "<script>
                window.onload = function() {
                    afficheCat('catUsers');
                };
            </script>";
    }
}

// Récupérer les liens
$stmt = $pdo->prepare("SELECT * FROM sections ORDER BY type_section");
$stmt->execute();
$liens = $stmt->fetchAll();

// Récupérer les utilisateurs
$stmtUsers = $pdo->prepare("SELECT * FROM users ORDER BY username");
$stmtUsers->execute();
$utilisateurs = $stmtUsers->fetchAll();

?>

<div class="bodycontent">
    <fieldset class="categorytoolbar">
        <div>
            <button class="toolbarbtn active" id="btnLiens" onclick="afficheCat('catliens')" class="active">Liens du Dashboard</button>
            <button class="toolbarbtn" id="btnUsers" onclick="afficheCat('catUsers')">Utilisateurs</button>
        </div>
    </fieldset>
    <hr>
    <?php include('parts/catliens.php'); ?>
    <?php include('parts/catusers.php'); ?>
</div>

<script src="fonctions.js"></script>

<?php include('parts/footer.php'); ?>