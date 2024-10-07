<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
// Récupérer les utilisateurs
$stmtUsers = $pdo->prepare("SELECT * FROM users ORDER BY username");
$stmtUsers->execute();
$utilisateurs = $stmtUsers->fetchAll();
?>

<div id="catusers" style="display:none;">
    <!-- Formulaire pour l'ajout et l'édition des utilisateurs -->
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
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($utilisateur['id']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['username']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['password']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['role']); ?></td>
                        <td>
                            <button
                                onclick="editUser(<?php echo htmlspecialchars(json_encode($utilisateur)); ?>)">Éditer</button>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $utilisateur['id']; ?>">
                                <input type="hidden" name="deleteUser" value="1">
                                <input type="submit" value="Supprimer"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
</div>