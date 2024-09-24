<!--
BK-Coding.net
file: parametres.php
author: Bastien Kilian
-->

<?php
$title = "parametres";
include('parts/header.php');
require_once('dbconfig.php');
?>

<div class="bodycontent">
    <fieldset class="categorytoolbar">
        <div>
            <button class="toolbarbtn active" id="btnLiens" onclick="afficheCat('catliens')" class="active">Liens du Dashboard</button>
            <button class="toolbarbtn" id="btnUsers" onclick="afficheCat('catUsers')">Utilisateurs</button>
        </div>
    </fieldset>
    <hr>
    <?php include('parts/catliens.php'); ?>
    <?php include('parts/catusers.php'); ?>
</div>

<script src="fonctions.js"></script>

<?php include('parts/footer.php'); ?>