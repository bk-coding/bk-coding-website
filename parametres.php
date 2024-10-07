<!--
BK-Coding.net
file: parametres.php
author: Bastien Kilian
-->

<?php
$title = "parametres";
include('parts/header.php');
require_once('dbconfig.php');

$categories = [
    ['id' => 'catliens', 'label' => 'Liens du Dashboard', 'active' => true],
    ['id' => 'catusers', 'label' => 'Utilisateurs', 'active' => false],
    ['id' => 'cattest', 'label' => 'Catégorie de test', 'active' => false],
    // Ajoutez d'autres catégories ici à l'avenir
];
?>

<div class="bodycontent">
    <fieldset class="categorytoolbar">
        <legend>Paramètres</legend>
        <div>
            <?php foreach ($categories as $category): ?>
                <button class="toolbarbtn <?= $category['active'] ? 'active' : ''; ?>"
                    id="btn<?= ucfirst($category['id']); ?>"
                    data-cat="<?= $category['id']; ?>"
                    onclick="afficheCat('<?= $category['id']; ?>')"
                    aria-pressed="<?= $category['active'] ? 'true' : 'false'; ?>">
                    <?= $category['label']; ?>
                </button>

            <?php endforeach; ?>
        </div>
    </fieldset>
    <hr>
    <?php
    // Inclusion dynamique des fichiers
    foreach ($categories as $category) {
        if (file_exists('parts/param/' . $category['id'] . '.php')) {
            include('parts/param/' . $category['id'] . '.php');
        } else {
            echo "<p>Erreur: Le fichier pour {$category['label']} est introuvable.</p>";
        }
    }
    ?>
</div>

<script src="fonctions.js"></script>

<?php include('parts/footer.php'); ?>