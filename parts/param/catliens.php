<?php
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
}

// Récupérer les liens
$stmt = $pdo->prepare("SELECT * FROM sections ORDER BY type_section");
$stmt->execute();
$liens = $stmt->fetchAll();
?>

<!-- Formulaire pour l'ajout et l'édition de lien -->
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
        <div><label for="nom_interne"> Nom interne : </label><input type="text" name="nom_interne" id="nom_interne"
                required></div>
        <div>
            <label for="cible"> Cible : </label>
            <select name="cible" id="cible" required>
                <option value="" disabled selected>Choisissez une cible</option>
                <option value="_self">Onglet actuel</option>
                <option value="_blank">Nouvel onglet</option>
            </select>
        </div>
        <div><label for="adresse_lien"> Lien : </label><input type="text" name="adresse_lien" id="adresse_lien"
                required></div>
        <div><label for="icon"> Icône : </label><input type="text" name="icon" id="icon" required></div>
        <div><label for="titre_bouton"> Titre du bouton : </label><input type="text" name="titre_bouton"
                id="titre_bouton"></div>
        <br />
        <div style="display:block; text-align:center;"><input type="reset" value="Effacer"><input type="submit"
                value="Enregistrer"></div>
    </form>
</fieldset>
<!-- Tableau des liens -->
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
            <?php foreach ($liens as $lien): ?>
                <tr>
                    <td data-label="Type de section"><?php echo htmlspecialchars($lien['type_section']); ?></td>
                    <td data-label="Nom interne"><?php echo htmlspecialchars($lien['nom_interne']); ?></td>
                    <td data-label="Cible"><?php echo htmlspecialchars($lien['cible']); ?></td>
                    <td data-label="Liens"><?php echo htmlspecialchars($lien['adresse_lien']); ?></td>
                    <td data-label="Icone"><?php echo htmlspecialchars($lien['icon']); ?> <i
                            class="fa-solid <?php echo htmlspecialchars($lien['icon']); ?>"></i></td>
                    <td data-label="Titre du bouton"><?php echo htmlspecialchars($lien['titre_bouton']); ?></td>
                    <td data-label="Actions">
                        <button onclick="editLien(<?php echo htmlspecialchars(json_encode($lien)); ?>)">Éditer</button>
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