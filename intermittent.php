<?php
$title = "intermittence";
include('parts/header.php');
require_once('dbconfig.php');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajout ou mise à jour d'un cachet
    if (isset($_POST['date_debut'], $_POST['date_fin'], $_POST['montant_brut'], $_POST['montant_net'], $_POST['description'])) {
        if ($_POST['id'] == 0) { // Ajout
            $stmt = $pdo->prepare("INSERT INTO cachets (date_debut, date_fin, montant_brut, montant_net, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['date_debut'], $_POST['date_fin'], $_POST['montant_brut'], $_POST['montant_net'], $_POST['description']]);
        } else { // Mise à jour
            $stmt = $pdo->prepare("UPDATE cachets SET date_debut = ?, date_fin = ?, montant_brut = ?, montant_net = ?, description = ? WHERE id = ?");
            $stmt->execute([$_POST['date_debut'], $_POST['date_fin'], $_POST['montant_brut'], $_POST['montant_net'], $_POST['description'], $_POST['id']]);
        }
    }

    // Suppression d'un cachet
    if (isset($_POST['delete']) && $_POST['id'] > 0) {
        $stmt = $pdo->prepare("DELETE FROM cachets WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }
}

// Récupération des cachets pour affichage
$cachets = $pdo->query("SELECT * FROM cachets")->fetchAll();

?>
<div class="bodycontent">
<!-- Formulaire pour l'ajout et l'édition -->
<form method="post">
    <input type="hidden" name="id" value="0" id="cachetId">
    <label for="date_debut">Date début:</label>
    <input type="date" name="date_debut" id="date_debut" required>
    <label for="date_fin">Date fin:</label>
    <input type="date" name="date_fin" id="date_fin" required>
    <label for="montant_brut">Montant Brut:</label>
    <input type="number" name="montant_brut" id="montant_brut" required>
    <label for="montant_net">Montant Net:</label>
    <input type="number" name="montant_net" id="montant_net" required>
    <label for="description">Description:</label>
    <input type="text" name="description" id="description">
    <input type="submit" value="Soumettre">
</form>

<!-- Tableau des cachets -->
<table>
    <tr>
        <th>Date Début</th>
        <th>Date Fin</th>
        <th>Montant Brut</th>
        <th>Montant Net</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($cachets as $cachet): ?>
    <tr>
        <td><?php echo htmlspecialchars($cachet['date_debut']); ?></td>
        <td><?php echo htmlspecialchars($cachet['date_fin']); ?></td>
        <td><?php echo htmlspecialchars($cachet['montant_brut']); ?></td>
        <td><?php echo htmlspecialchars($cachet['montant_net']); ?></td>
        <td><?php echo htmlspecialchars($cachet['description']); ?></td>
        <td>
            <button onclick="editCachet(<?php echo htmlspecialchars(json_encode($cachet)); ?>)">Éditer</button>
            <form method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $cachet['id']; ?>">
                <input type="hidden" name="delete" value="1">
                <input type="submit" value="Supprimer">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Calcul et affichage des totaux -->
<?php
$totalBrut = array_sum(array_column($cachets, 'montant_brut'));
$totalNet = array_sum(array_column($cachets, 'montant_net'));
?>
<p>Total Brut: <?php echo $totalBrut; ?></p>
<p>Total Net: <?php echo $totalNet; ?></p>

</div>
<!-- JavaScript pour remplir le formulaire en mode édition -->
<script>
function editCachet(cachet) {
    document.getElementById('cachetId').value = cachet.id;
    document.getElementById('date_debut').value = cachet.date_debut;
    document.getElementById('date_fin').value = cachet.date_fin;
    document.getElementById('montant_brut').value = cachet.montant_brut;
    document.getElementById('montant_net').value = cachet.montant_net;
    document.getElementById('description').value = cachet.description;
}
</script>

<?php include('parts/footer.php'); ?>