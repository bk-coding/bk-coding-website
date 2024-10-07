<!--
BK-Coding.net
file: parametres.php
author: Bastien Kilian
-->

<?php
$title = "parametres";
include('parts/header.php');
require_once('dbconfig.php');

// Lister les fichiers dans le dossier parts/param/
$categories = [];
foreach (glob('parts/param/*.php') as $filename) {
    $categoryId = basename($filename, '.php'); // Obtient le nom du fichier sans l'extension
    $active = (count($categories) === 0); // Active le premier
    $categories[] = [
        'id' => $categoryId,
        'label' => ucfirst(str_replace('cat', '', $categoryId)), // Reformate le label
        'active' => $active,
    ];
}
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
        if (file_exists('parts/param/' . $category['id'] . '.php')): ?>
            <div id="<?= $category['id'] ?>" style="display:<?= $category['active'] ? 'block' : 'none'; ?>;">
                <?php include('parts/param/' . $category['id'] . '.php'); ?>
            </div>
        <?php else: ?>
            <p>Erreur: Le fichier pour <?= $category['label']; ?> est introuvable.</p>
    <?php endif;
    }
    ?>
</div>

<script src="fonctions.js"></script>

<?php include('parts/footer.php'); ?>