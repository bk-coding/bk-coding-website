<!--
BK-Coding.net
file: dashboard.php
author: Bastien Kilian
 -->

<?php 
$title = "dashboard";
include('parts/header.php');
require_once('dbconfig.php');
?>

<div class="bodycontent">
    <?php 
    $sections = [
        "Applis" => [
            ["name" => "hostinger", "target" => "_blank", "href" => "https://hpanel.hostinger.com/websites/bk-coding.net", "icon" => "fa-server", "label" => "Hostinger"],
            ["name" => "github", "target" => "_blank", "href" => "https://github.com/bk-coding", "icon" => "fa-brands fa-github", "label" => "GitHub"],
            ["name" => "fontawesome", "target" => "_blank", "href" => "https://fontawesome.com/search", "icon" => "fa-font-awesome", "label" => "FontAwesome"],
            ["name" => "mdn", "target" => "_blank", "href" => "https://developer.mozilla.org/fr/docs/Web#r%C3%A9f%C3%A9rences_des_technologies_web", "icon" => "fa-book-bookmark", "label" => "MDN"]
        ],
        "Clients" => [
            ["name" => "banquet1", "target" => "_blank", "href" => "https://devsite.provins-banquet-medieval.com/wp-admin", "icon" => "fa-book-bookmark", "label" => "Banquet des Troubadours (old)"],
            ["name" => "banquet2", "target" => "_blank", "href" => "https://devsite.banquetdestroubadours.com/wp-admin", "icon" => "fa-book-bookmark", "label" => "Banquet des Troubadours (new)"],
            ["name" => "cemasophro", "target" => "_blank", "href" => "https://cemasophro.com/wp-admin", "icon" => "fa-book-bookmark", "label" => "Cemasophro"]
        ],
        "Outils Admin" => [
            ["name" => "hashmdp", "target" => "_self", "href" => "hashmdp.php", "icon" => "fa-clipboard-check", "label" => "HashMDP"],
            ["name" => "parametres", "target" => "_self", "href" => "parametres.php", "icon" => "fa-gears", "label" => "Paramètres"]
        ],
        "Outils" => [
            ["name" => "intermittent", "target" => "_self", "href" => "intermittent.php", "icon" => "fa-clipboard-check", "label" => "Intermittence"]
        ],
        "Autre" => [
            ["name" => "logout", "target" => "_self", "href" => "deconnexion.php", "icon" => "fa-right-from-bracket", "label" => "Vous n'avez pas de rôle, veuillez contacter l'administrateur à cette adresse : dev@bk-coding.net"]
        ]
    ];

    $userSections = [];

    if ($_SESSION['role'] === 'admin') {
        $userSections = [
            "Applis" => $sections["Applis"],
            "Clients" => $sections["Clients"],
            "Outils Admin" => $sections["Outils Admin"],
            "Outils" => $sections["Outils"]
        ];
    } elseif ($_SESSION['role'] === 'user') {
        $userSections = [
            "Outils" => $sections["Outils"]
        ];
    } else {
        $userSections = [
            "Autre" => $sections["Autre"]
        ];
    }

    foreach ($userSections as $legend => $links) {
        echo '<fieldset class="category">';
        echo "<legend>$legend</legend>";
        foreach ($links as $link) {
            echo '<a name="'.$link['name'].'" target="'.$link['target'].'" href="'.$link['href'].'">';
            echo '<div class="bouton">';
            echo '<div><i class="fa-solid '.$link['icon'].'"></i></div>';
            echo '<div>'.$link['label'].'</div>';
            echo '</div></a>';
        }
        echo '</fieldset>';
    }
    ?>
    <hr>
    <?php
    $stmtApplis = $pdo->prepare("SELECT * FROM sections WHERE type_section = ?");
    $stmtApplis->execute('Applis');
    $liensApplis = $stmtApplis->fetchAll();

    $stmtClients = $pdo->prepare("SELECT * FROM sections WHERE type_section = ?");
    $stmtClients->execute('Clients');
    $lienClients = $stmtClients->fetchAll();

    $stmtOutilsAdmin = $pdo->prepare("SELECT * FROM sections WHERE type_section = ?");
    $stmtOutilsAdmin->execute('Outils Admin');
    $lienOutilsAdmin = $stmtOutilsAdmin->fetchAll();

    $stmtOutils = $pdo->prepare("SELECT * FROM sections WHERE type_section = ?");
    $stmtOutils->execute('Outils');
    $lienOutils = $stmtOutils->fetchAll();

    $stmtAutre = $pdo->prepare("SELECT * FROM sections WHERE type_section = ?");
    $stmtAutre->execute('Autre');
    $lienAutre = $stmtAutre->fetchAll();

    $userSections2 = [];

    if ($_SESSION['role'] === 'admin') {
        $userSections2 = [
            "Applis" => $liensApplis,
            "Clients" => $lienClients,
            "Outils Admin" => $lienOutilsAdmin,
            "Outils" => $lienOutils
        ];
    } elseif ($_SESSION['role'] === 'user') {
        $userSections2 = [
            "Outils" => $lienOutils
        ];
    } else {
        $userSections2 = [
            "Autre" => $lienAutre
        ];
    }

    foreach ($userSections2 as $legend2 => $links2) {
        echo '<fieldset class="category">';
        echo "<legend>$legend2</legend>";
        foreach ($links2 as $link2) {
            echo '<a name="'.$link2['nom_interne'].'" target="'.$link2['cible'].'" href="'.$link2['adresse_lien'].'">';
            echo '<div class="bouton">';
            echo '<div><i class="fa-solid '.$link2['icon'].'"></i></div>';
            echo '<div>'.$link2['titre_bouton'].'</div>';
            echo '</div></a>';
        }
        echo '</fieldset>';
    }
    ?>
</div>

<?php include('parts/footer.php'); ?>