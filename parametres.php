<!--
BK-Coding.net
file: parametres.php
author: Bastien Kilian
-->

<?php
$title = "parametres";
include('parts/header.php');
require_once('dbconfig.php');

$stmt = $pdo->prepare("SELECT * FROM sections WHERE type_section = ? ORDER BY id");
$stmt->execute('Outils Admin');
$outilsadmin = $stmt->fetchAll();

?>
<div class="bodycontent">
<!-- Formulaire pour l'ajout et l'édition -->
<fieldset class="categoryajout">
        <legend>Ajouter/Editer un lien Outils Admin</legend>
        <form method="post">
            <input type="hidden" name="id" value="0" id="lienId">
            <input type="hidden" name="type_section" value="Outils Admin" id="type_section">
            <div><label for="nom_interne"> Nom interne : </label><input type="text" name="nom_interne" id="nom_interne" required></div>
            <div><label for="cible"> Cible : </label><input type="text" name="cible" id="cible" required></div>
            <div><label for="adresse_lien"> Lien : </label><input type="text" name="adresse_lien" id="adresse_lien" required></div>
            <div><label for="icon"> Icône : </label><input type="text" name="icon" id="icon" required></div>
            <div><label for="titre_bouton"> Titre du bouton : </label><input type="text" name="titre_bouton" id="titre_bouton"></div>
            <br />
            <div style="display:block; text-align:center;"><input type="reset" value="Effacer"><input type="submit" value="Enregistrer"></div>
        </form>
    </fieldset>
    <!-- Tableau des liens Outils Admin -->
    <fieldset class="categorytableau">
        <legend>Tableau des liens des Outils Admin</legend>
        <table class="tableaucachet">
            <thead>
                <tr>
                    <th>Nom interne</th>
                    <th>Cible</th>
                    <th>Liens</th>
                    <th>Icone</th>
                    <th>Titre du bouton</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outilsadmin as $lienoutilsadmin) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($lienoutilsadmin['nom_interne']); ?></td>
                        <td><?php echo htmlspecialchars($lienoutilsadmin['cible']); ?></td>
                        <td><?php echo htmlspecialchars($lienoutilsadmin['adresse_lien']); ?></td>
                        <td><?php echo htmlspecialchars($lienoutilsadmin['icon']); ?></td>
                        <td><?php echo htmlspecialchars($lienoutilsadmin['titre_bouton']); ?></td>
                        <td>
                            <button onclick="editLienOutilsAdmin(<?php echo htmlspecialchars(json_encode($lienoutilsadmin)); ?>)">Éditer</button>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $lienoutilsadmin['id']; ?>">
                                <input type="hidden" name="type_section" value="<?php echo $lienoutilsadmin['type_section']; ?>">
                                <input type="hidden" name="delete" value="1">
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>

    <script>
    function editLienoutilsadmin($lienoutilsadmin) {
        document.getElementById('lienId').value = $lienoutilsadmin.id;
        document.getElementById('type_section').value = $lienoutilsadmin.type_section;
        document.getElementById('nom_interne').value = $lienoutilsadmin.nom_interne;
        document.getElementById('cible').value = $lienoutilsadmin.cible;
        document.getElementById('adresse_lien').value = $lienoutilsadmin.adresse_lien;
        document.getElementById('icon').value = $lienoutilsadmin.icon;
        document.getElementById('titre_bouton').value = $lienoutilsadmin.titre_bouton;
        }
    </script>

<?php include('parts/footer.php'); ?>