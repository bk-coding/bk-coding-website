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
    <div id="paramtoolbar">
        <button id="btnLiens" onclick="afficheCat('catliens')" class="active">Liens du Dashboard</button>
        <button id="btnUsers" onclick="afficheCat('catUsers')">Utilisateurs</button>
    </div>
    <hr>
    <div id="catliens" style="display:block;">
        <!-- Formulaire pour l'ajout et l'édition -->
        <fieldset class="categoryajout">
            <legend>Ajouter/Editer un lien au Dashboard</legend>
            <form method="post">
            <input type="hidden" name="id" value="0" id="lienId">
            <div>
                <label for="type_section"> Type de section : </label>
                <select name="type_section" id="type_section" required>
                    <option value="" disabled selected>Choisissez un type de section</option>
                    <option value="Applis">Applis</option>
                    <option value="Clients">Clients</option>
                    <option value="Outils Admin">Outils Admin</option>
                    <option value="Outils">Outils</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div><label for="nom_interne"> Nom interne : </label><input type="text" name="nom_interne" id="nom_interne" required></div>
            <div>
                <label for="cible"> Cible : </label>
                <select name="cible" id="cible" required>
                    <option value="" disabled selected>Choisissez une cible</option>
                    <option value="_self">Onglet actuel</option>
                    <option value="_blank">Nouvel onglet</option>
                </select>
            </div>
            <div><label for="adresse_lien"> Lien : </label><input type="text" name="adresse_lien" id="adresse_lien" required></div>
            <div><label for="icon"> Icône : </label><input type="text" name="icon" id="icon" required></div>
            <div><label for="titre_bouton"> Titre du bouton : </label><input type="text" name="titre_bouton" id="titre_bouton"></div>
            <br />
            <div style="display:block; text-align:center;"><input type="reset" value="Effacer"><input type="submit" value="Enregistrer"></div>
            </form>
        </fieldset>
        <!-- Tableau des liens Outils Admin -->
        <fieldset class="categorytableau">
            <legend>Tableau des liens du Dashboard</legend>
            <table class="tableaucachet">
                <thead>
                    <tr>
                        <th>Type de section</th>
                        <th>Nom interne</th>
                        <th>Cible</th>
                        <th>Liens</th>
                        <th>Icone</th>
                        <th>Titre du bouton</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($liens as $lien) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lien['type_section']); ?></td>
                            <td><?php echo htmlspecialchars($lien['nom_interne']); ?></td>
                            <td><?php echo htmlspecialchars($lien['cible']); ?></td>
                            <td><?php echo htmlspecialchars($lien['adresse_lien']); ?></td>
                            <td><?php echo htmlspecialchars($lien['icon']); ?> <i class="fa-solid <?php echo htmlspecialchars($lien['icon']); ?>"></i></td>
                            <td><?php echo htmlspecialchars($lien['titre_bouton']); ?></td>
                            <td><button onclick="editLien(<?php echo htmlspecialchars(json_encode($lien)); ?>)">Éditer</button>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $lien['id']; ?>">
                                <input type="hidden" name="delete" value="1">
                                <input type="submit" value="Supprimer">
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div id="catUsers" style="display:none;">
        <fieldset class="categoryajout">
        <legend>Ajouter/Editer un Utilisateur</legend>
        <form method="post">
            <input type="hidden" name="user_id" value="0" id="userId">
            <div>
                <label for="username"> Nom d'utilisateur : </label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password"> Mot de passe : </label>
                <input type="text" name="password" id="password" required>
            </div>
            <div>
                <label for="email"> Adresse E-mail : </label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="role"> Rôle : </label>
                <select name="role" id="role" required>
                    <option value="" disabled selected>Choisissez un rôle</option>
                    <option value="admin">Admin</option>
                    <option value="user">Utilisateur</option>
                    <option value="guest">Invité</option>
                </select>
            </div>
            <br />
            <div style="display:block; text-align:center;">
                <input type="reset" value="Effacer">
                <input type="submit" value="Enregistrer">
            </div>
        </form>
        </fieldset>  
        <!-- Tableau des utilisateurs -->
        <fieldset class="categorytableau">
            <legend>Liste des Utilisateurs</legend>
            <table class="tableaucachet">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Mot de passe</th>
                    <th>Adresse E-mail</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($utilisateur['id']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['username']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['password']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['role']); ?></td>
                        <td>
                            <button onclick="editUser(<?php echo htmlspecialchars(json_encode($utilisateur)); ?>)">Éditer</button>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $utilisateur['id']; ?>">
                                <input type="hidden" name="deleteUser" value="1">
                                <input type="submit" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </fieldset>
    </div>
</div>

<script src="fonctions.js"></script>

<?php include('parts/footer.php'); ?>