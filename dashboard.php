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
    <fieldset class="categorychat">
        <legend>Chat</legend>
        <div class="chat-box" id="chat-box">
            <!-- Les messages vont être affichés ici -->
        </div>
        <div class="wid90">
            <form id="chat-form">
                <input type="hidden" id="username" value="<?php echo $_SESSION['username']; ?>" required>
                <div class="mar10 wid90"><input type="text" id="message" spellcheck="true" placeholder="Votre message" required></div>
                <div><button type="reset">Effacer</button><button type="submit">Envoyer</button></div>
            </form>
        </div>
    </fieldset>

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
        if ($role === 'admin' && in_array($type, ['Applis', 'Clients', 'Outils Admin', 'Outils'])) {
            $userSections[$type] = $links;
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
            echo '<a name="' . $link['nom_interne'] . '" target="' . $link['cible'] . '" href="' . $link['adresse_lien'] . '">';
            echo '<div class="bouton">';
            echo '<div><i class="fa-solid ' . $link['icon'] . '"></i></div>';
            echo '<div>' . $link['titre_bouton'] . '</div>';
            echo '</div></a>';
        }
        echo '</fieldset>';
    }
    ?>
</div>

<script>
    const chatForm = document.getElementById('chat-form');
    chatForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const message = document.getElementById('message').value;

        // Envoi du message via une requête AJAX à PHP
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'parts/send_message.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                loadMessages(); // Recharge les messages après l'envoi
            }
        };
        xhr.send(`username=${username}&message=${message}`);

        // Réinitialise le champ du message
        document.getElementById('message').value = '';
    });

    function loadMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'parts/load_messages.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = this.responseText;
                // Scroller automatiquement vers le bas
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };
        xhr.send();
    }

    // Charger les messages dès que la page est chargée
    window.onload = function() {
        loadMessages();
    };

    // Charger les messages toutes les 2 secondes
    setInterval(loadMessages, 2000);
</script>

<?php include('parts/footer.php'); ?>