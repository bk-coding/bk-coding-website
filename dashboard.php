<?php $title = "dashboard";
include('parts/header.php'); ?>

<div class="bodycontent">
    <fieldset class="category">
        <legend>Applis</legend>
        <a name="hostinger" target="_blank" href="https://hpanel.hostinger.com/websites/bk-coding.net"><div class="bouton"><div><i class="fa-solid fa-server"></i></div><div>Hostinger</div></div></a>
        <a name="github" target="_blank" href="https://github.com/bk-coding"><div class="bouton"><div><i class="fa-brands fa-github"></i></div><div>GitHub</div></div></a>
        <a name="fontawesome" target="_blank" href="https://fontawesome.com/search"><div class="bouton"><div><i class="fa-solid fa-font-awesome"></i></div><div>FontAwesome</div></div></a>
        <a name="mdn" target="_blank" href="https://developer.mozilla.org/fr/docs/Web#r%C3%A9f%C3%A9rences_des_technologies_web"><div class="bouton"><div><i class="fa-solid fa-book-bookmark"></i></div><div>MDN</div></div></a>
    </fieldset>
    <fieldset class="category">
        <legend>Clients</legend>
        <a name="banquet" target="_blank" href="https://devsite.provins-banquet-medieval.com/wp-admin"><div class="bouton"><div><i class="fa-solid fa-book-bookmark"></i></div><div>Banquet des Troubadours</div></div></a>
    </fieldset>
    <fieldset class="category">
        <legend>Outils</legend>
        <a name="intermittent" target="_self" href="intermittent.php"><div class="bouton"><div><i class="fa-solid fa-clipboard-check"></i></div><div>Intermittence</div></div></a>
        <a name="hashmdp" target="_self" href="hashmdp.php"><div class="bouton"><div><i class="fa-solid fa-clipboard-check"></i></div><div>HashMDP</div></div></a>
    </fieldset>
</div>

<?php include('parts/footer.php'); ?>