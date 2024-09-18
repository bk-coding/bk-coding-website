<?php 
$title = "dashboard";
include('parts/header.php'); ?>

<div class="bodycontent">
    <?php 
    $sections = [
        "Applis" => [
            ["name" => "hostinger", "target" => "_blank", "href" => "https://hpanel.hostinger.com/websites/bk-coding.net", "icon" => "fa-server", "label" => "Hostinger"],
            ["name" => "github", "target" => "_blank", "href" => "https://github.com/bk-coding", "icon" => "fa-github", "label" => "GitHub"],
            ["name" => "fontawesome", "target" => "_blank", "href" => "https://fontawesome.com/search", "icon" => "fa-font-awesome", "label" => "FontAwesome"],
            ["name" => "mdn", "target" => "_blank", "href" => "https://developer.mozilla.org/fr/docs/Web#r%C3%A9f%C3%A9rences_des_technologies_web", "icon" => "fa-book-bookmark", "label" => "MDN"]
        ],
        "Clients" => [
            ["name" => "banquet", "target" => "_blank", "href" => "https://devsite.provins-banquet-medieval.com/wp-admin", "icon" => "fa-book-bookmark", "label" => "Banquet des Troubadours"],
            ["name" => "cemasophro", "target" => "_blank", "href" => "https://cemasophro.com/wp-admin", "icon" => "fa-book-bookmark", "label" => "Cemasophro"]
        ],
        "Outils" => [
            ["name" => "intermittent", "target" => "_self", "href" => "intermittent.php", "icon" => "fa-clipboard-check", "label" => "Intermittence"],
            ["name" => "hashmdp", "target" => "_self", "href" => "hashmdp.php", "icon" => "fa-clipboard-check", "label" => "HashMDP"]
        ]
    ];

    foreach ($sections as $legend => $links) {
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
</div>

<?php include('parts/footer.php'); ?>