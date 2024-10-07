<!--
BK-Coding.net
file: intermittent.php
author: Bastien Kilian
-->

<?php
$title = "intermittence";
include('parts/header.php');
$user = $username;

require_once('dbconfig.php');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajout ou mise à jour d'un cachet
    if (isset($_POST['user'], $_POST['date_debut'], $_POST['date_fin'], $_POST['nombre_cachet'], $_POST['nombre_heure'], $_POST['montant_brut'], $_POST['montant_net'], $_POST['description'])) {
        if ($_POST['id'] == 0) { // Ajout
            $stmt = $pdo->prepare("INSERT INTO devcachets (user, date_debut, date_fin, nombre_cachet, nombre_heure, montant_brut, montant_net, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['user'], $_POST['date_debut'], $_POST['date_fin'], $_POST['nombre_cachet'], $_POST['nombre_heure'], $_POST['montant_brut'], $_POST['montant_net'], $_POST['description']]);
        } else { // Mise à jour
            $stmt = $pdo->prepare("UPDATE devcachets SET date_debut = ?, date_fin = ?, nombre_cachet = ?, nombre_heure = ?, montant_brut = ?, montant_net = ?, description = ? WHERE id = ?");
            $stmt->execute([$_POST['date_debut'], $_POST['date_fin'], $_POST['nombre_cachet'], $_POST['nombre_heure'], $_POST['montant_brut'], $_POST['montant_net'], $_POST['description'], $_POST['id']]);
        }
    }

    // Suppression d'un cachet
    if (isset($_POST['delete']) && $_POST['id'] > 0) {
        $stmt = $pdo->prepare("DELETE FROM devcachets WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }
}

// Récupération des cachets pour affichage
$stmt = $pdo->prepare("SELECT * FROM devcachets WHERE user = :user ORDER BY date_debut DESC");
$stmt->bindValue(':user', $user);
$stmt->execute();
$cachets = $stmt->fetchAll();

?>
<div class="bodycontent">
    <!-- Formulaire pour l'ajout et l'édition -->
    <fieldset class="categoryajout">
        <legend>Ajouter/Editer une date</legend>
        <form method="post" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="0" id="cachetId">
            <input type="hidden" name="user" value="<?php echo $user; ?>" id="user">
            <div><label for="date_debut">Date début : </label><input type="date" name="date_debut" id="date_debut" required></div>
            <div><label for="date_fin"> Date fin : </label><input type="date" name="date_fin" id="date_fin" required></div>
            <div><label for="nombre_cachet"> Nombre de cachet : </label><input type="number" name="nombre_cachet" id="nombre_cachet" required oninput="toggleFields()"></div>
            <div><label for="nombre_heure"> Nombre d'heures : </label><input type="number" name="nombre_heure" id="nombre_heure" required oninput="toggleFields()"></div>
            <div><label for="montant_brut"> Montant Brut : </label><input type="text" name="montant_brut" id="montant_brut" required oninput="updateMontantNet()"></div>
            <div><label for="montant_net"> Montant Net : </label><input type="text" name="montant_net" id="montant_net" onfocus="setCalculable(false)" onblur="setCalculable(true)"></div>
            <div><label for="description"> Description : </label><input type="text" name="description" id="description"></div>
            <br />
            <div style="display:block; text-align:center;"><input type="reset" value="Effacer"><input type="submit" value="Enregistrer"></div>
        </form>
    </fieldset>
    <!-- Tableau des cachets -->
    <fieldset class="categorytableau">
        <legend>Tableau des cachets</legend>
        <table class="tableaucachet">
            <thead>
                <tr>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Nombre de cachets</th>
                    <th>Nombre d'heures</th>
                    <th>Montant Brut</th>
                    <th>Montant Net</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cachets as $cachet) : ?>
                    <tr>
                        <td><?php $datedebut = date_create(htmlspecialchars($cachet['date_debut']));
                            echo date_format($datedebut, "d/m/Y"); ?></td>
                        <td><?php $datefin = date_create(htmlspecialchars($cachet['date_fin']));
                            echo date_format($datefin, "d/m/Y"); ?></td>
                        <td><?php echo htmlspecialchars($cachet['nombre_cachet']); ?></td>
                        <td><?php echo htmlspecialchars($cachet['nombre_heure']); ?></td>
                        <td><?php echo htmlspecialchars($cachet['montant_brut']); ?></td>
                        <td><?php echo htmlspecialchars($cachet['montant_net']); ?></td>
                        <td><?php echo htmlspecialchars($cachet['description']); ?></td>
                        <td>
                            <button onclick="editCachet(<?php echo htmlspecialchars(json_encode($cachet)); ?>)">Éditer</button>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $cachet['id']; ?>">
                                <input type="hidden" name="user" value="<?php echo $cachet['user']; ?>">
                                <input type="hidden" name="delete" value="1">
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>

    <!-- Calcul et affichage des totaux -->
    <?php
    $NombreHeure = array_sum(array_column($cachets, 'nombre_heure'));
    $NombreCachet = array_sum(array_column($cachets, 'nombre_cachet'));
    $totalNombreCachet = intdiv($NombreHeure, 12) + $NombreCachet;
    $totalNombreHeure = ($NombreCachet * 12) + $NombreHeure;
    $totalBrut = array_sum(array_column($cachets, 'montant_brut'));
    $totalNet = array_sum(array_column($cachets, 'montant_net'));
    ?>
    <fieldset class="categorytableau">
        <legend>Totaux</legend>
        <table class="tableaucachet">
            <thead>
                <tr>
                    <th>Total en cachets</th>
                    <th>Total en heures</th>
                    <th>Total Brut</th>
                    <th>Total Net</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $totalNombreCachet; ?></td>
                    <td><?php echo $totalNombreHeure; ?></td>
                    <td><?php echo $totalBrut; ?></td>
                    <td><?php echo $totalNet; ?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>

</div>

<script src="fonctions.js"></script>

<?php include('parts/footer.php'); ?>